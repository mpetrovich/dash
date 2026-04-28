# Contributing

Dash's modular design makes it easy to contribute. Operations are implemented as pure functions that can be reused and composed to make new operations. The best way to understand how Dash works is to examine the source code of any of the existing operations.

If you encounter a bug or have a suggestion, please [create a new GitHub issue](https://github.com/mpetrovich/dash/issues/new). We want your feedback!

### Quickstart

If you just want the essentials:

```
git clone https://github.com/mpetrovich/dash.git
cd dash
make
make test
make check-style
```

See [Dev setup](#dev-setup) for the full workflow, including release steps.

### Organization

This repository is organized as follows:

-   `src/`: Individual operations implemented as pure functions.
-   `src/Curry/`: Curried versions of most operations.
-   `tests/`: Unit tests for all operations. Curried and non-curried versions of the same operation are tested in the same test class.
-   `docs/`: Documentation.
-   `bin/`: Utility scripts, such as one for generating documentation from all operations' docblock comments.
-   `Makefile`: Makefile used to build, run tests, check coding style, and more.

### Dev setup

Use this workflow to go from a fresh clone to a tagged release.

1. Install prerequisites:

-   PHP 7.4+
-   [Composer](https://getcomposer.org/)

2. Clone the repository and enter the project directory:

```
git clone https://github.com/mpetrovich/dash.git
cd dash
```

3. Install dependencies (including dev tools):

```
make
```

4. Run the full test suite:

```
make test
```

To run tests for a single operation:

```
make test op=map
```

5. Check style (and optionally auto-fix style issues):

```
make check-style
make fix-style
```

6. Regenerate operation docs when behavior, signatures, or docblocks change:

```
make docs
```

7. Before opening a PR, ensure generated docs are committed (if changed), tests pass, and style checks pass.

8. Create a release (maintainers):

```
make release v=1.2.3
```

`make release` runs tests, rebuilds docs, commits `docs/Operations.md` (if needed), creates an annotated tag (`v1.2.3`), and pushes commits and tags.

### Important notes

-   Dash supports legacy versions of PHP, so make sure your contributions work on the oldest supported version of PHP.
-   Dash uses [PHPUnit](https://phpunit.de/) for unit testing, and unit tests are automatically run on [Travis CI](https://travis-ci.org/mpetrovich/dash) against new branches and pull requests. Tests are run across all supported PHP versions.
-   Dash uses [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) for linting.
-   Dash is **strict** about following [semantic versioning](https://semver.org/).

### Docker workflow (optional)

Use Docker as an alternative to local setup when you want a reproducible environment without installing PHP and Composer directly on your machine.

Build the Docker image using the Makefile helper (defaults to PHP 7.4):

```
make docker-build
```

Build with a specific PHP version:

```
make docker-build PHP_VERSION=8.2
```

Run common development tasks through Docker:

```
make docker-make-install
make docker-make-test
make docker-make-check-style
make docker-make-docs
```

You can pass `PHP_VERSION` (and `op` where applicable) to these targets:

```
make docker-make-test PHP_VERSION=8.2 op=map
```

Open an interactive shell in the configured Docker image:

```
make docker-shell PHP_VERSION=8.2
```
