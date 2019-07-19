<?php

namespace spec\drupol\PhpCsFixerConfigsDrupal\Config;

use drupol\PhpCsFixerConfigsDrupal\Config\Drupal7;
use PhpSpec\ObjectBehavior;

class Drupal7Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Drupal7::class);
    }
}
