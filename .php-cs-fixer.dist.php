<?php

$finder = \PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude(['tests/Integration/fixtures'])
    ->in(__DIR__);

$config = new \PhpCsFixer\Config();

return $config->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'phpdoc_align' => ['align' => 'vertical', 'tags' => ['type', 'var']],
    ])
    ->setFinder($finder)

;
