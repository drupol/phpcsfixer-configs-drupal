# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.1.0] - 2023-10-23
### Added
- add CHANGELOG with history of changes
- add Fixer Drupal/blank_line_after_start_of_class (#7)
- fix broken whitespace on Control Structure (#12)
- add no_blank_lines_after_phpdoc:curly_brace_block (#8)

### Fixed
- fix broken whitespace on Control Structure Fixer (#12)
- fix broken whitespace on Try-Catch Fixer (#12)
- fix broken whitespace on BlankLineBeforeEndOfClass Fixer (#12)

### Changed
- refactoring of tests integration using PHPUnit & Github Actions
- replace deprecated braces configuration by curly_braces_position (#8)
- replace deprecated curly_braces_position configuration by braces_position (#8)
- replace braces:position_after_control_structures by control_structure_continuation_position:position (#8)
- replace deprecated braces by single_space_around_construct (#8)
- enable class_attributes_separation: true following phpcs (drupal/coder) rules (#8)
- replace deprecated no_blank_lines_after_phpdoc:use_trait by class_attributes_separation: true (#8)
- replace deprecated no_spaces_inside_parenthesis by spaces_inside_parentheses:space:none instead (#8)
- replace deprecated compact_nullable_typehint by compact_nullable_type_declaration (#8)
- raise minimal friendsofphp/php-cs-fixer version from ^3.18 to ^3.35 (#8)

### Removed
- remove NewlineAfterLastCommaInArrayFixer now that a similar rule has been included in PHP CS Fixer

### Security
- update phpunit/phpunit (9.6.13 => 10.4.1)

### Deprecated
- deprecate Fixer ControlStructureCurlyBracketsElseFixerTest now that a similar rule (control_structure_continuation_position:position:next_line) has been included in PHP CS Fixer (#8)
- deprecate Fixer TryCatchFinallyBlockFixer now that a similar rule (control_structure_continuation_position:position:next_line) has been included in PHP CS Fixer (#8)

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

[Unreleased]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/2.1.0...HEAD
[2.1.0]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/2.0.1...2.1.0
[2.0.1]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.8...2.0.0
[1.0.8]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.7...1.0.8
[1.0.7]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.6...1.0.7
[1.0.6]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.5...1.0.6
[1.0.5]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.4...1.0.5
[1.0.4]: https://github.com/drupol/phpcsfixer-configs-drupal/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/drupol/phpcsfixer-configs-drupal/releases/tag/1.0.3
