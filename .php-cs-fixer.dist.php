<?php

$config = require __DIR__ . '/vendor/drupol/php-conventions/config/php73/php_cs_fixer.config.php';

$config
    ->getFinder()
    ->exclude(['tests/functional/fixtures', 'tests/_output/fixtures']);

return $config;
