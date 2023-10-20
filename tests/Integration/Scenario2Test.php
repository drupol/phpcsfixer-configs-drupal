<?php

namespace Integration;

use drupol\PhpCsFixerConfigsDrupal\Config\Drupal8;
use drupol\PhpCsFixerConfigsDrupal\Tests\IntegrationTestCase;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet\RuleSet;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass
 * @covers \drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass
 *
 * @internal
 */
final class Scenario2Test extends IntegrationTestCase
{
    protected function getScenarioPath(): string
    {
        return __DIR__ . '/fixtures/scenario2';
    }

    public function testDrupal8Config(): void
    {
        $drupal8 = new Drupal8();
        $rules = $drupal8->getRules();
        $ruleset = new RuleSet($rules);

        $factory = (new FixerFactory())
            ->registerBuiltInFixers()
            ->registerCustomFixers($drupal8->getCustomFixers())
            ->useRuleSet($ruleset);

        $fixers = [];
        foreach ($factory->getFixers() as $fixer) {
            $fixers[$fixer->getName()] = $fixer;
        }

        //        unset($fixers['Drupal/control_structure_braces_else']);
        //        unset($fixers['Drupal/try_catch_block']);
        //        unset($fixers['Drupal/blank_line_after_start_of_class']);
        //        unset($fixers['Drupal/blank_line_before_end_of_class']);

        $this->doTest($fixers);
    }
}
