<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests;

use BadMethodCallException;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\PhpunitConstraintIsIdenticalString\Constraint\IsIdenticalString;
use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;
use SplFileInfo;

/**
 * Provides setup methods for Fixer testing.
 */
abstract class FixerTestCase extends TestCase
{
    use AssertTokensTrait;

    protected function createFixer(): FixerInterface
    {
        throw new BadMethodCallException(sprintf('Method "%s" is not implemented.', __METHOD__));
    }

    /**
     * Run the Fixer tests.
     */
    protected function doTest(string $expected, string $input = null): void
    {
        if (null === $input) {
            $input = $expected;
        }

        $file = new SplFileInfo(__FILE__);
        $tokens = Tokens::fromCode($input);
        $this->fixer->fix($file, $tokens);

        self::assertTrue($tokens->isChanged(), 'Tokens collection built on input code must be marked as changed after fixing.');

        self::assertThat($tokens->generateCode(), new IsIdenticalString($expected), 'Code build on expected code must not change.');

        $expectedTokens = Tokens::fromCode($expected);
        self::assertTokens($expectedTokens, $tokens);
    }
}
