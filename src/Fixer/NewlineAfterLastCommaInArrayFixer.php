<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace drupol\PhpCsFixerConfigsDrupal\Fixer;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\TokensAnalyzer;
use PhpCsFixer\WhitespacesFixerConfig;
use SplFileInfo;

use const T_ARRAY;
use const T_INLINE_HTML;
use const T_OPEN_TAG;
use const T_WHITESPACE;

final class NewlineAfterLastCommaInArrayFixer extends AbstractFixer implements FixerInterface, WhitespacesAwareFixerInterface
{
    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        $tokensAnalyzer = new TokensAnalyzer($tokens);

        for ($index = $tokens->count() - 1; 0 <= $index; --$index) {
            if ($tokensAnalyzer->isArray($index) && $tokensAnalyzer->isArrayMultiLine($index)) {
                $this->fixArray($tokens, $index);
            }
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'In array declaration, if the array is multiline, the closing tag must be on a newline.',
            [new CodeSample("<?php\n\$sample = array(1,'a',\$b,);\n")]
        );
    }

    /**
     * Returns the name of the fixer.
     *
     * The name must be all lowercase and without any spaces.
     *
     * @return string The name of the fixer
     */
    public function getName(): string
    {
        return 'Drupal/new_line_on_multiline_array';
    }

    /**
     * Returns the priority of the fixer.
     *
     * The default priority is 0 and higher priorities are executed first.
     */
    public function getPriority(): int
    {
        return 10000;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAnyTokenKindsFound([T_ARRAY, CT::T_ARRAY_SQUARE_BRACE_OPEN]);
    }

    /**
     * Check if fixer is risky or not.
     *
     * Risky fixer could change code behavior!
     */
    public function isRisky(): bool
    {
        return false;
    }

    public function setWhitespacesConfig(WhitespacesFixerConfig $config): void
    {
        $this->whitespacesConfig = $config;
    }

    /**
     * Returns true if the file is supported by this fixer.
     *
     * @return bool true if the file is supported by this fixer, false otherwise
     */
    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    /**
     * @param int    $index
     */
    private function fixArray(Tokens $tokens, $index): void
    {
        $startIndex = $index;

        if ($tokens[$startIndex]->isGivenKind(T_ARRAY)) {
            $startIndex = $tokens->getNextTokenOfKind($startIndex, ['(']);
            $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $startIndex);
        } else {
            $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_ARRAY_SQUARE_BRACE, $startIndex);
        }

        $equalIndex = $tokens->getPrevTokenOfKind($startIndex - 1, ['=']);

        $indent = '';

        if (null !== $equalIndex) {
            $assignedVarIndex = $tokens->getPrevMeaningfulToken($equalIndex);
            $indent = $this->getIndentAt($tokens, $assignedVarIndex - 1);
        }

        $lineEnding = $this->whitespacesConfig->getLineEnding();

        $beforeEndIndex = $tokens->getPrevMeaningfulToken($endIndex);
        $beforeEndToken = $tokens[$beforeEndIndex];

        if ($startIndex !== $beforeEndIndex && !$beforeEndToken->equalsAny([$lineEnding])) {
            $tokens->insertAt($beforeEndIndex + 1, new Token([T_WHITESPACE, $lineEnding]));
        }
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
}
