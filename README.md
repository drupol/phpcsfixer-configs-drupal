[![Latest Stable Version](https://img.shields.io/packagist/v/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![GitHub stars](https://img.shields.io/github/stars/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![Total Downloads](https://img.shields.io/packagist/dt/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![Build Status](https://img.shields.io/travis/drupol/phpcsfixer-configs-drupal/master.svg?style=flat-square)](https://travis-ci.org/drupol/phpcsfixer-configs-drupal)
 [![Scrutinizer code quality](https://img.shields.io/scrutinizer/quality/g/drupol/phpcsfixer-configs-drupal/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phpcsfixer-configs-drupal/?branch=master)
 [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/drupol/phpcsfixer-configs-drupal/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phpcsfixer-configs-drupal/?branch=master)
 [![Mutation testing badge](https://badge.stryker-mutator.io/github.com/drupol/phpcsfixer-configs-drupal/master)](https://stryker-mutator.github.io)
 [![License](https://img.shields.io/packagist/l/drupol/phpcsfixer-configs-drupal.svg?style=flat-square)](https://packagist.org/packages/drupol/phpcsfixer-configs-drupal)
 [![Say Thanks!](https://img.shields.io/badge/Say-thanks-brightgreen.svg?style=flat-square)](https://saythanks.io/to/drupol)
 [![Donate!](https://img.shields.io/badge/Donate-Paypal-brightgreen.svg?style=flat-square)](https://paypal.me/drupol)
 
# PHP-Cs-Fixer Drupal Configurations

## Description

This package provides a set [PHP-Cs-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) configuration objects ready to be used in a Drupal project.

## Documentation

Available configuration objects:

* `drupol\PhpCsFixerConfigsDrupal\Config\Drupal6`
* `drupol\PhpCsFixerConfigsDrupal\Config\Drupal7`

## Requirements

* PHP >= 5.6

## Installation

```composer require --dev drupol/phpcsfixer-configs-drupal```

## Usage

See the [PHP CS Fixer documentation](https://github.com/FriendsOfPHP/PHP-CS-Fixer) on how to use the configuration object.

## Code quality, tests and benchmarks

Every time changes are introduced into the library, [Travis CI](https://travis-ci.org/drupol/phpcsfixer-configs-drupal/builds) run the tests and the benchmarks.

The library has tests written with [PHPSpec](http://www.phpspec.net/).
Feel free to check them out in the `spec` directory. Run `composer phpspec` to trigger the tests.

Before each commit some inspections are executed with [GrumPHP](https://github.com/phpro/grumphp), run `./vendor/bin/grumphp run` to check manually.

[PHPInfection](https://github.com/infection/infection) is used to ensure that your code is properly tested, run `composer infection` to test your code.

## Contributing

Feel free to contribute to this library by sending Github pull requests. I'm quite reactive :-)
