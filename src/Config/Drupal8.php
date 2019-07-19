<?php

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
            ->withRulesFromYaml('/../../config/drupal8/phpcsfixer.rules.yml');

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
