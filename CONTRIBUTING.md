Contributing
===
Dash's modular design makes it easy to contribute. Operations are implemented as pure functions that can be reused and composed to make new operations. The best way to understand how Dash works is to examine the source code of any of the existing operations.

If you encounter a bug or have a suggestion, please [create a new GitHub issue](https://github.com/nextbigsoundinc/dash/issues/new). We want your feedback!

### Organization
This repository is organized as follows:
- `src/`: Individual operations implemented as pure functions.
- `src/Curry/`: Curried versions of most operations.
- `tests/`: Unit tests for all operations. Curried and non-curried versions of the same operation are tested in the same test class.
- `docs/`: Documentation.
- `bin/`: Utility scripts, such as one for generating documentation from
all operations' docblock comments.
- `Makefile`: Makefile used to build, run tests, check coding style, and more.

### Important notes
- Dash supports legacy versions of PHP, so make sure your contributions work on the oldest supported version of PHP.
- Dash uses [PHPUnit](https://phpunit.de/) for unit testing, and unit tests are automatically run on [Travis CI](https://travis-ci.org/nextbigsoundinc/dash) against new branches and pull requests. Tests are run across all supported PHP versions.
- Dash uses [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) for linting.
- Dash is **strict** about following [semantic versioning](https://semver.org/).
