<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Unit\Fixer;

use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass;
use drupol\PhpCsFixerConfigsDrupal\Tests\FixerTestCase;
use PhpCsFixer\Fixer\FixerInterface;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @internal
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass
 */
final class BlankLineAfterStartOfClassFixerTest extends FixerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->fixer = $this->createFixer();
    }

    protected function createFixer(): FixerInterface
    {
        return new BlankLineAfterStartOfClass();
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
}
