<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Config;

use drupol\PhpCsFixerConfigsPhp\Config\YamlConfig;

/**
 * Class Drupal7.
 */
final class Drupal7 extends YamlConfig
{
    /**
     * Drupal7 constructor.
     */
    public function __construct()
    {
        parent::__construct('drupal7');

        $parent = (new Drupal())
            ->withRulesFromYaml(__DIR__ . '/../../config/drupal7/phpcsfixer.rules.yml');

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
