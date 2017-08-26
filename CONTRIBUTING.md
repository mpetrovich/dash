Contributing
===

##### You can contribute by:
- [Reporting issues](https://github.com/mpetrovich/Dash/issues/new)
- [Submitting feature requests](https://github.com/mpetrovich/Dash/issues/new?labels=enhancement)
- [Adding new operations](#adding-new-operations)


Adding new operations
---
**If you want to add custom Dash operations for your own application, see `Dash\custom()`.**
To contribute new operations to the main Dash repository, read on.

Dash's modular design makes it easy to add new operations.

##### Example
Suppose we want a `squares` operation that squares the values within an iterable collection:

```php
_::squares([1, 2, 3]);  // === [1, 4, 9]
```

To add a new `squares` operation, we follow a few simple steps:

#### 1. Create a new `src/squares` directory containing the source and test files.

```
src/squares/squares.php
            squaresTest.php
```

#### 2. Define the new `squares` operation as a freestanding function within the `Dash` namespace.

Leverage other Dash operations to keep the code simple and performant, and remember to include function-level phpdocs. Note that since the file is within the `Dash` namespace, other operations can be accessed without the `Dash\` namespace qualifier.

```php
<?php

namespace Dash;

/**
 * @param iterable $iterable
 * @return array $iterable with each of its values squared
 */
function squares($iterable)
{
	return map($iterable, function ($value) {
		return $value * $value;
	});
}
```

#### 3. Write unit tests that fully cover all logic.

Conventions to follow:
- Test a variety of input types and cases, including arrays, `stdClass` objects, and `ArrayObject` instances. Data providers are helpful here.
- Add an `@covers` annotation to ensure that code coverage gets correctly attributed to this test.
- When invoking the method under test, use the standalone form `Dash\squares()` rather than the static form `_::squares()`.

```php
<?php

/**
 * @covers Dash\squares
 */
class squaresTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		$this->assertEquals($expected, Dash\squares($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'expected' => [],
			],
			'With an empty array' => [
				'input' => [],
				'expected' => [],
			],
			'With an array' => [
				'input' => [1, 2, 3],
				'expected' => [1, 4, 9],
			],
			'With an empty stdClass' => [
				'input' => (object),
				'expected' => [],
			],
			'With a non-empty stdClass' => [
				'input' => (object) [1, 2, 3],
				'expected' => [1, 4, 9],
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject(),
				'expected' => [],
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'expected' => [1, 4, 9],
			],
		];
	}
}
```

#### 4. Add `src/squares/squares.php` to the `autoload.files` section of the `composer.json` file.

In alphabetical order, too.

```json
{
	"name": "mpetrovich/dash",
	"description": "A functional utility library for PHP, like Underscore and Lodash",
	"autoload": {
		"files": [
			"src/all/all.php",
			…
			"src/sort/squares.php",
```


Running tests
---
This repository includes a makefile with several useful commands:

#### `make test [op=<operation>]`
Runs all unit tests (via PHPUnit) or only those for the specified `<operation>` (eg. `map`, `filter`).

#### `make test-coverage [op=<operation>]`
Generates unit test code coverage (via PHPUnit) for all tests or only those for the specified `<operation>` (eg. `map`, `filter`).

#### `make check-style [op=<operation>]`
Checks code formatting (via PHPCS) across all source or only those for the specified `<operation>` (eg. `map`, `filter`).

#### `make fix-style [op=<operation>]`
Checks and tries to automatically fix code formatting issues across all source or only those for the specified `<operation>` (eg. `map`, `filter`). Not all formatting issues can be fixed automatically.

#### `make docs`
Auto-generates the Markdown file containing documentation for all operations, `DOCS.md`.
