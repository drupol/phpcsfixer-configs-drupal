<?php

namespace drupol\PhpCsFixerConfigsDrupal\Tests\Integration;

use drupol\PhpCsFixerConfigsDrupal\Config\Drupal8;
use drupol\PhpCsFixerConfigsDrupal\Tests\IntegrationTestCase;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet\RuleSet;

/**
 * @author Kevin Wenger <wenger.kev@gmail.com>
 *
 * Covers the PHP-CS-Fixer rules fully_qualified_strict_types.phpdoc_tags
 *
 * @internal
 */
final class Scenario8Test extends IntegrationTestCase
{
    protected function getScenarioPath(): string
    {
        return __DIR__ . '/fixtures/scenario8';
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

        $this->doTest($fixers);
    }
}
