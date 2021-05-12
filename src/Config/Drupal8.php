<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Config;

use drupol\PhpCsFixerConfigsPhp\Config\YamlConfig;

/**
 * Class Drupal8.
 */
final class Drupal8 extends YamlConfig
{
    /**
     * Drupal8 constructor.
     */
    public function __construct()
    {
        parent::__construct('drupal8');

        $parent = (new Drupal7())
            ->withRulesFromYaml(__DIR__ . '/../../config/drupal8/phpcsfixer.rules.yml');

        $this
            ->setRules($parent->getRules());

        $this
            ->setIndent($parent->getIndent());

        $this
            ->setLineEnding($parent->getLineEnding());

        $this
            ->registerCustomFixers($parent->getCustomFixers());

        $this
            ->setRiskyAllowed($parent->getRiskyAllowed());

        $this
            ->setFinder($parent->getFinder());
    }
}
