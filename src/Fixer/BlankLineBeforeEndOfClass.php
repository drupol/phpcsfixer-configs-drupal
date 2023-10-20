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
use PhpCsFixer\Tokenizer\TokensAnalyzer;
use PhpCsFixer\WhitespacesFixerConfig;
use SplFileInfo;

use const T_WHITESPACE;

final class BlankLineBeforeEndOfClass extends AbstractFixer implements FixerInterface, WhitespacesAwareFixerInterface
{
    /**
     * @var Tokens
     */
    private $tokens;

    /**
     * @var TokensAnalyzer
     */
    private $tokensAnalyzer;

    public function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        $this->tokens = $tokens;
        $this->tokensAnalyzer = new TokensAnalyzer($this->tokens);

        foreach ($tokens as $index => $token) {
            if (!$token->isClassy()) {
                continue;
            }

            $indexOpenCurlyBrace = $tokens->getNextTokenOfKind($index, ['{']);
            $endCurlyBraceIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_CURLY_BRACE, $indexOpenCurlyBrace);

            // Count the number of new lines before the closing brace.
            $newLines = Preg::matchAll('/\R/', $tokens[$endCurlyBraceIndex - 1]->getContent(), $matches);

            // If the previous token is already a new line, then we don't need to add another one.
            if ($newLines >= 2) {
                continue;
            }

            $eol = $this->whitespacesConfig->getLineEnding();
            $prevToken = $tokens[$endCurlyBraceIndex - 1];

            // Add a new line(s) (without ident) before the ending braces.
            switch ($newLines) {
                case 0:
                    // When the closing brace is on the same line as the open brace, we need to add two new lines.
                    $tokens[$endCurlyBraceIndex - 1] = new Token([T_WHITESPACE, trim($prevToken->getContent(), $this->whitespacesConfig->getIndent()) . str_repeat($eol, 2)]);
                    break;

                case 1:
                default:
                    $tokens[$endCurlyBraceIndex - 1] = new Token([T_WHITESPACE, trim($prevToken->getContent(), $this->whitespacesConfig->getIndent()) . $eol]);
            }

            // Get the padding of the opening brace to be replicated on the closing brace.
            $padding = mb_substr(
                $this->getExpectedIndentAt($tokens, $indexOpenCurlyBrace),
                0,
                -mb_strlen($this->whitespacesConfig->getIndent())
            );

            // Add the padding to the closing brace.
            $tokens[$endCurlyBraceIndex] = new Token(
                [
                    T_WHITESPACE,
                   $padding . $this->tokens[$endCurlyBraceIndex]->getContent(),
                ]
            );
        }
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

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'A class must have a blank line before the last closing brace.',
            [
                new CodeSample(
                    ''
                ),
            ]
        );
    }

    public function getName(): string
    {
        return 'Drupal/blank_line_before_end_of_class';
    }

    public function getPriority(): int
    {
        return -10000;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
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
}
