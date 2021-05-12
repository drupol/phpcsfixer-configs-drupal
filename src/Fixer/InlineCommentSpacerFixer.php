<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Fixer;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

use const PHP_EOL;
use const T_COMMENT;

/**
 * Class InlineCommentSpacerFixer.
 */
final class InlineCommentSpacerFixer implements FixerInterface
{
    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            $content = $token->getContent();

            if (!$token->isComment() || 0 !== mb_strpos($content, '//') || 0 === mb_strpos($content, '// ')) {
                continue;
            }

            if ('//' === $token->getContent()) {
                continue;
            }

            $content = substr_replace($content, ' ', 2, 0);
            $tokens[$index] = new Token([$token->getId(), $content]);
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'Puts a space after every inline comment start.',
            [
                new CodeSample('<?php //Whut' . PHP_EOL),
            ]
        );
    }

    public function getName(): string
    {
        return 'Drupal/inline_comment_spacer';
    }

    public function getPriority(): int
    {
        return 30;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_COMMENT);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }
}
