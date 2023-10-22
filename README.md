[![Latest Stable Version](https://img.shields.io/packagist/v/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![GitHub stars](https://img.shields.io/github/stars/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![Total Downloads](https://img.shields.io/packagist/dt/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![License](https://img.shields.io/packagist/l/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![Say Thanks!](https://img.shields.io/badge/Say-thanks-brightgreen.svg?style=flat-square)](https://saythanks.io/to/drupol)
 [![Donate!](https://img.shields.io/badge/Donate-Paypal-brightgreen.svg?style=flat-square)](https://paypal.me/drupol)

# PHP CS Fixer Drupal Configurations

## Description

This package provides a set [PHP-Cs-Fixer](https://github.com/FriendsOfPHP/PHP CS Fixer) configuration objects ready to be used in a Drupal project.

## Documentation

Available configuration objects:

* `drupol\PhpCsFixerConfigsDrupal\Config\Drupal7`
* `drupol\PhpCsFixerConfigsDrupal\Config\Drupal8`

## Requirements

* PHP >= 8.0
* friendsofphp/php-cs-fixer >= 3.35

## Installation

The recommended way to install PHP CS Fixer Drupal is to use Composer in a dedicated `composer.json` file in your project, for example in the `tools/php-cs-fixer` directory:

```bash
mkdir -p tools/php-cs-fixer
composer require --dev --working-dir=tools/php-cs-fixer drupol/phpcsfixer-configs-drupal
```

Or using the main `composer.json`:

```bash
composer require --dev drupol/phpcsfixer-configs-drupal
```

## Configuration

Assuming you installed PHP CS Fixer as instructed above, you should now setup a configuration `.php-cs-fixer.php` file in the root directory of your project.

```bash
touch .php-cs-fixer.php
```

The example below setup PHP CS Fixer to use Drupal 8/9/10 rules:

```php
<?php

use drupol\PhpCsFixerConfigsDrupal\Config\Drupal8;

$finder = PhpCsFixer\Finder::create()
  ->in(['web/modules/custom'])
  ->name('*.module')
  ->name('*.inc')
  ->name('*.install')
  ->name('*.test')
  ->name('*.profile')
  ->name('*.theme')
  ->notPath('*.md')
  ->notPath('*.info.yml')
;

$config = new Drupal8();
$config->setFinder($finder);

$rules = $config->getRules();

$config->setRules($rules);
return $config;
```

See the [PHP CS Fixer documentation](https://github.com/FriendsOfPHP/PHP-CS-Fixer) on how to use the advanced configuration object.

## Usage

Assuming you installed PHP CS Fixer as instructed above, you can run the following command to fix your Drupal project:

```bash
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix
```

## Code quality, tests and benchmarks

Every time changes are introduced into the library, [Github Actions](https://github.com/drupol/phpcsfixer-configs-drupal/actions) run the tests and the benchmarks.

The library has tests written with [PHPUnit](https://phpunit.de/).
Feel free to check them out in the `tests` directory. Run `./vendor/bin/phpunit` to trigger the tests.

Before each commit some inspections are executed with [GrumPHP](https://github.com/phpro/grumphp), run `./vendor/bin/grumphp run` to check manually.

## Contributing

Feel free to contribute to this library by sending Github pull requests. I'm quite reactive :-)
