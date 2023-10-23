<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Fixer;

use drupol\PhpCsFixerConfigsDrupal\Fixer\ControlStructureCurlyBracketsElseFixer;
use drupol\PhpCsFixerConfigsDrupal\Tests\FixerTestCase;
use PhpCsFixer\Fixer\FixerInterface;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\ControlStructureCurlyBracketsElseFixer
 *
 * @deprecated in 2.1.0 and is removed from 3.0.0. Instead, use
 *      control_structure_continuation_position:position:next_line.
 */
final class ControlStructureCurlyBracketsElseFixerTest extends FixerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->fixer = $this->createFixer();
    }

    protected function createFixer(): FixerInterface
    {
        return new ControlStructureCurlyBracketsElseFixer();
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
            '<?php if ($some) { $test = true; }
else { $test = false; }',
            '<?php if ($some) { $test = true; } else { $test = false; }',
        ];

        yield [
            '<?php if ($some) { $test = true; }
else if ($some !== "test") { $test = false; }',
            '<?php if ($some) { $test = true; } else if ($some !== "test") { $test = false; }',
        ];

        yield [
            '<?php if ($some) { $test = true; }
else  if ($some !== "test") { $test = false; }',
            '<?php if ($some) { $test = true; } else  if ($some !== "test") { $test = false; }',
        ];

        yield [
            '<?php
                    if ($a) {
                        $x = 1;
                    }
                    else
                    if ($b) {
                        $x = 2;
                    }',
            '<?php
                    if ($a) {
                        $x = 1;
                    } else
                    if ($b) {
                        $x = 2;
                    }',
        ];

        yield [
            '<?php
                    if ($a) {
                    }
                    else /**/ if ($b) {
                    }
                ',
            '<?php
                    if ($a) {
                    } else /**/ if ($b) {
                    }
                ',
        ];

        yield [
            '<?php
                    if ($a) {
                    }
                    else //
                        if ($b) {
                    }
                ',
            '<?php
                    if ($a) {
                    } else //
                        if ($b) {
                    }
                ',
        ];

        yield [
            '<?php if ($a) {} 
else if ($b){}',
            '<?php if ($a) {} /**/else if ($b){}',
        ];

        yield [
            '<?php if ($x) { foo(); }
else if ($y): bar(); endif;',
            '<?php if ($x) { foo(); } else if ($y): bar(); endif;',
        ];
    }

    /**
     * @dataProvider provideWithElseCases
     */
    public function testWithElse(string $expected, string $input = null): void
    {
        $this->doTest($expected, $input);
    }

    public static function provideWithElseCases(): iterable
    {
        // Else should be moved on the next line after closing if bracket.
        yield [
            '<?php 
            if ($a) {
                $a = 1;
            }
            else {
                $a = 2;
            }',
            '<?php 
            if ($a) {
                $a = 1;
            } else {
                $a = 2;
            }',
        ];

        // Embed Else should still have proper indent.
        yield [
            '<?php 
            if ($a) {
                $a = 1;
                
                if ($c) {
                  $a = 3;
                }
                else {
                  $a = 4;
                }
            }',
            '<?php 
            if ($a) {
                $a = 1;
                
                if ($c) {
                  $a = 3;
                } else {
                  $a = 4;
                }
            }',
        ];
    }

    /**
     * @dataProvider provideWithElseIfCases
     */
    public function testWithElseIf(string $expected, string $input = null): void
    {
        $this->doTest($expected, $input);
    }

    public static function provideWithElseIfCases(): iterable
    {
        // Else should be moved on the next line after closing if bracket.
        yield [
            '<?php 
            if ($a) {
                $a = 1;
            }
            elseif ($b) {
                $a = 2;
            }',
            '<?php 
            if ($a) {
                $a = 1;
            } elseif ($b) {
                $a = 2;
            }',
        ];
    }
}
