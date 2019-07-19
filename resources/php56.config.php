<?php

use drupol\PhpCsFixerConfigsPhp\Config\Php56;

$config = Php56::create();

$config
    ->getFinder()
    ->exclude(['tests/functional/fixtures', 'tests/_output/fixtures']);

return $config;
