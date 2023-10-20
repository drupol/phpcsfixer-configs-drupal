<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Fixer;

use drupol\PhpCsFixerConfigsDrupal\Fixer\InlineCommentSpacerFixer;
use drupol\PhpCsFixerConfigsDrupal\Tests\FixerTestCase;
use PhpCsFixer\Fixer\FixerInterface;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\InlineCommentSpacerFixer
 */
final class InlineCommentSpacerFixerTest extends FixerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->fixer = $this->createFixer();
    }

    protected function createFixer(): FixerInterface
    {
        return new InlineCommentSpacerFixer();
    }

    /**
     * @dataProvider provideFixCases
     */
    public function testFix(string $expected, string $input = null): void
    {
        $this->doTest($expected, $input);
    }

    public static function provideFixCases(): iterable
    {
        yield [
            '<?php // Lorem Ipsum.',
            '<?php //Lorem Ipsum.',
        ];

        yield [
            '<?php // lorem Ipsum.',
            '<?php //lorem Ipsum.',
        ];

        yield [
            '<?php // lorem ipsum',
            '<?php //lorem ipsum',
        ];
    }
}
