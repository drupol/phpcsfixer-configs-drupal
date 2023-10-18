# CONTRIBUTING

We're using [Github Actions](https://travis-ci.com) as a continuous integration system.
 
For details, see [`workflows`](./.github/workflows). 

We're using [`grumphp/grumphp`](https://github.com/phpro/grumphp) to drive the development.
 
## Tests

We're using [`phpunit/phpunit`](https://phpunit.de/) to drive the development.

Run

```bash
./vendor/bin/phpunit
```

to run all the tests.

## Coding Standards

We are using PhpCsFixer Symfony rules to enforce coding standards.

Run

```bash
./vendor/bin/php-cs-fixer fix --dry-run
```

to automatically detect/fix coding standard violations.

```bash
./vendor/bin/php-cs-fixer fix
```
