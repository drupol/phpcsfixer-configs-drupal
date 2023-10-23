<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Fixer;

use drupol\PhpCsFixerConfigsDrupal\Fixer\TryCatchFinallyBlockFixer;
use drupol\PhpCsFixerConfigsDrupal\Tests\FixerTestCase;
use PhpCsFixer\Fixer\FixerInterface;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\TryCatchFinallyBlockFixer
 *
 * @deprecated in 2.1.0 and is removed from 3.0.0. Instead, use
 *     control_structure_continuation_position:position:next_line.
 */
final class TryCatchFinallyBlockFixerTest extends FixerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->fixer = $this->createFixer();
    }

    protected function createFixer(): FixerInterface
    {
        return new TryCatchFinallyBlockFixer();
    }

    /**
     * @dataProvider provideWithTryCatchCases
     */
    public function testWithTryCatch(string $expected, string $input = null): void
    {
        $this->doTest($expected, $input);
    }

    public static function provideWithTryCatchCases(): iterable
    {
        // Catch should be moved on the next line after closing try bracket.
        yield [
            '<?php 
            try {
            }
            catch (\ExceptionType $e) {
            }',
            '<?php 
            try {
            } catch (\ExceptionType $e) {
            }',
        ];

        // Multiple catches should be moved properly.
        yield [
            '<?php 
            try {
            }
            catch (\ExceptionType $e) {
            }
            catch (\BadArgumentException $e) {
            }',
            '<?php 
            try {
            } catch (\ExceptionType $e) {
            }
            catch (\BadArgumentException $e) {
            }',
        ];
    }

    /**
     * @dataProvider provideWithFinallyCases
     */
    public function testWithFinally(string $expected, string $input = null): void
    {
        $this->doTest($expected, $input);
    }

    public static function provideWithFinallyCases(): iterable
    {
        // Finally should be moved on the next line after closing catch bracket.
        yield [
            '<?php 
            try {
            }
            catch (\ExceptionType $e) {
            }
            finally {
            }',
            '<?php 
            try {
            }
            catch (\ExceptionType $e) {
            } finally {
            }',
        ];
    }
}
