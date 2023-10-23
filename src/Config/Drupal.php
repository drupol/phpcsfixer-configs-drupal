<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace drupol\PhpCsFixerConfigsDrupal\Config;

use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineAfterStartOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\BlankLineBeforeEndOfClass;
use drupol\PhpCsFixerConfigsDrupal\Fixer\InlineCommentSpacerFixer;
use drupol\PhpCsFixerConfigsPhp\Config\Php;
use drupol\PhpCsFixerConfigsPhp\Config\YamlConfig;

/**
 * Class Drupal.
 */
final class Drupal extends YamlConfig
{
    /**
     * Drupal constructor.
     */
    public function __construct()
    {
        parent::__construct('/drupol/drupal-conventions/drupal');

        $parent = (new Php())
            ->withRulesFromYaml(__DIR__ . '/../../config/drupal/phpcsfixer.rules.yml');

        $this
            ->setRules($parent->getRules());

        $this
            ->setIndent('  ');

        $this
            ->setLineEnding($parent->getLineEnding());

        $this
            ->registerCustomFixers([
                new BlankLineAfterStartOfClass(),
                new BlankLineBeforeEndOfClass(),
                new InlineCommentSpacerFixer(),
            ]);

        $this
            ->setRiskyAllowed(true);

        $this
            ->setFinder(
                $parent->getFinder()
                    ->name('*.inc')
                    ->name('*.install')
                    ->name('*.module')
                    ->name('*.profile')
                    ->name('*.php')
                    ->name('*.theme')
                    ->in($_SERVER['PWD'])
            );
    }
}
