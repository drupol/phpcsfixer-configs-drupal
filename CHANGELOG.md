# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
- add CHANGELOG with history of changes
- add Fixer Drupal/blank_line_after_start_of_class (#7)
- fix broken whitespace on Control Structure (#12)

### Fixed
- fix broken whitespace on Control Structure Fixer (#12)
- fix broken whitespace on Try-Catch Fixer (#12)
- fix broken whitespace on BlankLineBeforeEndOfClass Fixer (#12)

### Changed
- refactoring of tests integration using PHPUnit & Github Actions

### Removed
- remove NewlineAfterLastCommaInArrayFixer now that a similar rule has been included in PHP CS Fixer

## [2.0.1] - 2021-05-12
### Fixed
- fix removal of inheritdoc

## [2.0.0] - 2021-05-12
### Added
- upgrade for Drupal 7 and 8

## [1.0.8] - 2020-05-20
### Fixed
- fix typo in config

## [1.0.7] - 2020-05-20
### Changed
- update rule global_namespace_import:import_classes (true => false) to prevent conflicts with drupal/coder

## [1.0.6] - 2020-03-05
### Added
- add global_namespace_import parameters (#3)

## [1.0.5] - 2019-11-04
### Removed
- remove Fixer UppercaseConstantsFixer now that this rule has been included in PHP CS Fixer

## [1.0.4] - 2019-08-13
### Removed
- remove enforcement declare_strict_types to true on Drupal 8 as Drupal Core doesn't enforce it

## [1.0.3] - 2019-08-13
### Changed
- update rules

[Unreleased]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/2.0.1...HEAD
[2.0.1]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.8...2.0.0
[1.0.8]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.7...1.0.8
[1.0.7]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.6...1.0.7
[1.0.6]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.5...1.0.6
[1.0.5]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.4...1.0.5
[1.0.4]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/drupol/phpcsfixer-configs-drupal/releases/tag/1.0.3
