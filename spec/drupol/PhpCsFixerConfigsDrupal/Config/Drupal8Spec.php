<?php

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
