<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\drupol\PhpCsFixerConfigsDrupal\Config;

use drupol\PhpCsFixerConfigsDrupal\Config\Drupal8;
use PhpSpec\ObjectBehavior;

class Drupal8Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Drupal8::class);
    }
}
