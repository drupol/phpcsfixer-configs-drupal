<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Fixer;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\WhitespacesFixerConfig;
use SplFileInfo;

use const T_ELSE;
use const T_ELSEIF;
use const T_IF;
use const T_INLINE_HTML;
use const T_OPEN_TAG;
use const T_WHITESPACE;

/**
 * Class ControlStructureCurlyBracketsElseFixer.
 *
 * @deprecated replaced by control_structure_continuation_position:position:next_line
 */
final class ControlStructureCurlyBracketsElseFixer extends AbstractFixer implements FixerInterface, WhitespacesAwareFixerInterface
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'Fix if/else control structure.',
            [
                new CodeSample(
                    ''
                ),
            ]
        );
    }

    public function getName(): string
    {
        return 'Drupal/control_structure_braces_else';
    }

    public function getPriority(): int
    {
        return -1000;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAnyTokenKindsFound([T_IF, T_ELSE, T_ELSEIF]);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function setWhitespacesConfig(WhitespacesFixerConfig $config): void
    {
        $this->whitespacesConfig = $config;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    /**
     * @param int $start index of first meaningful token on previous line
     * @param int $end   index of last token on previous line
     */
    private function currentLineRequiresExtraIndentLevel(Tokens $tokens, int $start, int $end): bool
    {
        $firstMeaningful = $tokens->getNextMeaningfulToken($start);

        if ($tokens[$firstMeaningful]->isObjectOperator()) {
            $thirdMeaningful = $tokens->getNextMeaningfulToken($tokens->getNextMeaningfulToken($firstMeaningful));

            return
                $tokens[$thirdMeaningful]->equals('(')
                && $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $thirdMeaningful) > $end;
        }

        return
            !$tokens[$end]->equals(')')
            || $tokens->findBlockStart(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $end) >= $start;
    }

    /**
     * Mostly taken from MethodChainingIndentationFixer.
     *
     * @param int    $index  index of the first token on the line to indent
     */
    private function getExpectedIndentAt(Tokens $tokens, int $index): string
    {
        $index = $tokens->getPrevMeaningfulToken($index);
        $indent = $this->whitespacesConfig->getIndent();

        for ($i = $index; $i >= 0; --$i) {
            if ($tokens[$i]->equals(')')) {
                $i = $tokens->findBlockStart(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $i);
            }

            $currentIndent = $this->getIndentAt($tokens, $i);
            if (null === $currentIndent) {
                continue;
            }

            if ($this->currentLineRequiresExtraIndentLevel($tokens, $i, $index)) {
                return $currentIndent . $indent;
            }

            return $currentIndent;
        }

        return $indent;
    }

    /**
     * Mostly taken from MethodChainingIndentationFixer.
     *
     * @param int    $index  index of the indentation token
     */
    private function getIndentAt(Tokens $tokens, int $index): ?string
    {
        if (Preg::match('/\R{1}(\h*)$/', $this->getIndentContentAt($tokens, $index), $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Mostly taken from MethodChainingIndentationFixer.
     *
     * {@inheritdoc}
     */
    private function getIndentContentAt(Tokens $tokens, int $index): string
    {
        if (!$tokens[$index]->isGivenKind([T_WHITESPACE, T_INLINE_HTML])) {
            return '';
        }

        $content = $tokens[$index]->getContent();

        if ($tokens[$index]->isWhitespace() && $tokens[$index - 1]->isGivenKind(T_OPEN_TAG)) {
            $content = $tokens[$index - 1]->getContent() . $content;
        }

        if (Preg::match('/\R/', $content)) {
            return $content;
        }

        return '';
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isGivenKind([T_ELSE, T_ELSEIF])) {
                continue;
            }

            // Ignore old style constructions.
            // if ($something):
            $next = $tokens->getNextNonWhitespace($index);

            if ($token->isGivenKind([T_ELSE])) {
                if (':' === $tokens[$next]->getContent()) {
                    continue;
                }
            }

            // Ignore old style constructions.
            // elseif ($something):
            if ($token->isGivenKind([T_ELSEIF])) {
                if ('(' === $tokens[$next]->getContent()) {
                    $endParenthesis = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $next);

                    $next = $tokens->getNextNonWhitespace($endParenthesis);

                    if (':' === $tokens[$next]->getContent()) {
                        continue;
                    }
                }
            }

            $tokens[$index - 1] = new Token(
                [
                    T_WHITESPACE,
                    $this->whitespacesConfig->getLineEnding(), ]
            );

            $padding = mb_substr(
                $this->getExpectedIndentAt($tokens, $index),
                0,
                -mb_strlen($this->whitespacesConfig->getIndent())
            );

            $tokens[$index] = new Token(
                [
                    T_WHITESPACE,
                    $padding . $tokens[$index]->getContent(), ]
            );
        }
    }
}
