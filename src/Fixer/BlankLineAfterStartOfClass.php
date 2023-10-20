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
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\WhitespacesFixerConfig;
use SplFileInfo;

use const T_WHITESPACE;

final class BlankLineAfterStartOfClass extends AbstractFixer implements FixerInterface, WhitespacesAwareFixerInterface
{
    public function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isClassy()) {
                continue;
            }

            $indexOpenCurlyBrace = $tokens->getNextTokenOfKind($index, ['{']);
            $tokens->insertAt($indexOpenCurlyBrace + 1, new Token([T_WHITESPACE, $this->whitespacesConfig->getLineEnding()]));
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'A class must have a blank line after the first closing brace.',
            [
                new CodeSample(
                    ''
                ),
            ]
        );
    }

    public function getName(): string
    {
        return 'Drupal/blank_line_after_start_of_class';
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
