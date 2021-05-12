<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Fixer;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\TokensAnalyzer;
use PhpCsFixer\WhitespacesFixerConfig;
use SplFileInfo;

use const T_WHITESPACE;

final class BlankLineBeforeEndOfClass implements FixerInterface, WhitespacesAwareFixerInterface
{
    /**
     * @var Tokens
     */
    private $tokens;

    /**
     * @var TokensAnalyzer
     */
    private $tokensAnalyzer;

    /**
     * @var \PhpCsFixer\WhitespacesFixerConfig
     */
    private $whitespacesConfig;

    /**
     * BlankLineAfterStatementFixer constructor.
     *
     * @param mixed $indent
     * @param mixed $lineEnding
     */
    public function __construct($indent, $lineEnding)
    {
        $this->setWhitespacesConfig(
            new WhitespacesFixerConfig($indent, $lineEnding)
        );
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        $this->tokens = $tokens;
        $this->tokensAnalyzer = new TokensAnalyzer($this->tokens);

        foreach ($tokens as $index => $token) {
            if (!$token->isClassy()) {
                continue;
            }

            $indexOpenCurlyBrace = $tokens->getNextTokenOfKind($index, ['{']);

            $endCurlyBraceIndex = $tokens->findBlockEnd(
                Tokens::BLOCK_TYPE_CURLY_BRACE,
                $indexOpenCurlyBrace
            );

            $this->tokens[$endCurlyBraceIndex] = new Token([
                T_WHITESPACE,
                $this->whitespacesConfig->getLineEnding() . $this->tokens[$endCurlyBraceIndex]->getContent(),
            ]);
        }
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
