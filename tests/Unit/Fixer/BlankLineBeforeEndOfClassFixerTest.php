<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Fixer;

use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass;
use drupol\PhpCsFixerConfigsDrupal\Tests\FixerTestCase;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass
 */
final class BlankLineBeforeEndOfClassFixerTest extends FixerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->fixer = $this->createFixer();
    }

    protected function createFixer(): FixerInterface
    {
        return new BlankLineBeforeEndOfClass();
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
            '<?php class Bar {

}',
            '<?php class Bar { }',
        ];

        yield [
            '<?php

            class Bar {

            }',
            '<?php

            class Bar {}',
        ];

        yield [
            '<?php

            class Bar {
              public ?string $foo = null;

            }',
            '<?php

            class Bar {
              public ?string $foo = null;
            }',
        ];
    }

    /**
     * @dataProvider provideSkippedCases
     */
    public function testSkipped(string $input): void
    {
        $file = new SplFileInfo(__FILE__);
        $tokens = Tokens::fromCode($input);
        $this->fixer->fix($file, $tokens);
        self::assertFalse($tokens->isChanged());
    }

    public static function provideSkippedCases(): iterable
    {
        yield [
            '<?php

            class Bar {

                public $id;

            }',
        ];
    }
}
