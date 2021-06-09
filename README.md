# Dash &nbsp; [![Latest Stable Version](https://poser.pugx.org/mpetrovich/dash/version)](https://packagist.org/packages/mpetrovich/dash) [![Build Status](https://travis-ci.org/mpetrovich/dash.svg?branch=master)](https://travis-ci.org/mpetrovich/dash) [![codecov](https://codecov.io/gh/mpetrovich/dash/branch/master/graph/badge.svg)](https://codecov.io/gh/mpetrovich/dash)

**A functional programming library for PHP.** Inspired by Underscore, Lodash, and Ramda.

```php
$avgMaleAge = Dash\chain([
	['name' => 'John', 'age' => 12, 'gender' => 'male'],
	['name' => 'Jane', 'age' => 34, 'gender' => 'female'],
	['name' => 'Pete', 'age' => 23, 'gender' => 'male'],
	['name' => 'Mark', 'age' => 11, 'gender' => 'male'],
	['name' => 'Mary', 'age' => 42, 'gender' => 'female'],
])
->filter(['gender', 'male'])
->map('age')
->average()
->value();

echo "Average male age is $avgMaleAge.";
```

#### Jump to:

-   [Functions / Operations](#operations)
-   [Highlights](#highlights)
-   [Why use Dash?](#why-use-dash)
-   [Installation](#installation)
-   [Usage](#usage)
    -   [Standalone](#standalone)
    -   [Chaining](#chaining)
    -   [Supported data types](#supported-data-types)
    -   [Currying](#currying)
    -   [Lazy evaluation](#lazy-evaluation)
    -   [Custom operations](#custom-operations)
    -   [Tips](#tips)
-   [Changelog](https://github.com/mpetrovich/dash/releases)
-   [Roadmap](docs/Roadmap.md)
-   [Contributing](CONTRIBUTING.md)

## Operations

[View full list of operations here](docs/Operations.md)

## Highlights

-   [Many data types supported](#supported-data-types): arrays, objects, generators ([coming soon](https://github.com/mpetrovich/dash/issues/3)), [`Traversable`](http://php.net/manual/en/class.traversable.php), [`DirectoryIterator`](http://php.net/manual/en/class.directoryiterator.php), and more
-   [Chaining](#chaining)
-   [Currying](#currying)
-   [Lazy evaluation](#lazy-evaluation)
-   [Custom operations](#custom-operations)
-   Well-tested: Comprehensive tests with nearly 3,000 test cases and [100% code coverage](https://codecov.io/gh/mpetrovich/dash)

## Why use Dash?

PHP's built-in `array_*` functions are limited, difficult to compose, inconsistent, and don't work across many data types.

For instance, let's say we want to find the average age of males in this list:

```php
$people = [
	['name' => 'John', 'age' => 12, 'gender' => 'male'],
	['name' => 'Jane', 'age' => 34, 'gender' => 'female'],
	['name' => 'Pete', 'age' => 23, 'gender' => 'male'],
	['name' => 'Mark', 'age' => 11, 'gender' => 'male'],
	['name' => 'Mary', 'age' => 42, 'gender' => 'female'],
];
```

Using PHP's built-in in functions, we might write something like this:

```php
$males = array_filter($people, function ($person) {
	return $person['gender'] === 'male';
});
$avgMaleAge = array_sum(array_column($males, 'age')) / count($males);
```

Dash makes common data transformation operations simpler:

```php
$avgMaleAge = Dash\chain($people)
	->filter(['gender', 'male'])
	->map('age')
	->average()
	->value();
```

This is just a tiny subset of what Dash can do. [**See the full list of operations here.**](docs/Operations.md)

## Installation

Requires PHP 7.4+

```sh
composer require mpetrovich/dash
```

## Usage

Dash operations are pure functions that can be used alone or chained together.

### Standalone

Operations can be called as namespaced functions:

```php
Dash\map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

or as static methods:

```php
use Dash\Dash;

Dash::map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

`Dash\_` can also be used as an alias for `Dash\Dash`:

```php
use Dash\_;

_::map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

### Chaining

Multiple operations can be chained in sequence using `chain()`. Call `value()` to return the final value.

```php
$result = Dash\chain([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();

// $result === [2, 6, 10]
```

To explicitly convert the value to an array or `stdClass`, use `arrayValue()` or `objectValue()` respectively:

```php
$result = Dash\chain(['a' => 1, 'b' => 2, 'c' => 3])
	->filter('Dash\isOdd')
	->mapValues(function ($n) { return $n * 2; })
	->objectValue();

// $result === (object) ['a' => 2, 'c' => 6]
```

For convenience, `Dash\chain()` can be aliased to a global function using `addGlobalAlias()`. It only needs to be called once during your application bootstrap:

```php
// In your application bootstrap:
Dash::addGlobalAlias('__');

// Elsewhere:
$result = __([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();
```

Sometimes you don't need the return value of the chain. However, the chain isn't processed until `value()` is called. For semantic convenience, `run()` is also an alias for `value()`:

```php
$chain = Dash\chain(range(1, 5))
	->reverse()
	->each(function ($n) {
		echo "T-minus $n...\n";
		sleep(1);
	});

// Nothing echoed yet

$chain->value();
// or
$chain->run();

// Echoes each of the following lines 1 second apart:
// T-minus 5...
// T-minus 4...
// T-minus 3...
// T-minus 2...
// T-minus 1...
```

### Supported data types

Dash can work with a wide variety of data types, including:

-   arrays
-   objects (eg. `stdClass`)
-   generators ([still in development](https://github.com/mpetrovich/dash/issues/3))
-   anything that implements the [`Traversable`](http://php.net/manual/en/class.traversable.php) interface
-   [`DirectoryIterator`](http://php.net/manual/en/class.directoryiterator.php), which is also a `Traversable` but cannot normally be used with `iterator_to_array()` [due to a PHP bug](https://bugs.php.net/bug.php?id=49755). Dash works around this transparently.

#### Examples

With an array:

```php
Dash\chain([1, 2, 3, 4])
	->filter('Dash\isEven')
	->map(function ($value) {
		return $value * 2;
	})
	->value();
// === [4, 8]
```

With an object:

```php
Dash\chain((object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4])
	->filter('Dash\isOdd')
	->keys()
	->join(', ')
	->value();
// === 'a, c'
```

With a `Traversable`:

```php
Dash\chain(new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]))
	->pick(['b', 'c'])
	->values()
	->sum()
	->value();
// === 5
```

With a `DirectoryIterator`:

```php
$iterator = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);

$filenames = Dash\chain($iterator)
	->reject(function ($fileinfo) {
		return $fileinfo->isDir();
	})
	->map(function ($fileinfo) {
		return pathinfo($fileinfo)['filename'];
	})
	->value();
```

### Currying

[`curry()`](docs/Operations.md#curry) and related operations can be used to create curried functions from any callable:

```php
function listThree($a, $b, $c) {
	return "$a, $b, and $c";
}

$listThree = Dash\curry('listThree');
$listTwo = $listThree('first');
$listTwo('second', 'third');  // === 'first, second, and third'
```

Most Dash functions have a curried version that accepts input data as the last parameter instead of as the first. Curried versions are located in the `Dash\Curry` namespace:

```php
Dash\chain([
	'a' => 3,
	'b' => '3',
	'c' => 3,
	'd' => 3.0
])
->filter(Dash\Curry\identical(3))
->value();
// === ['a' => 3, 'c' => 3]
```

Similarly, [`partial()`](docs/Operations.md#partial) and related operations can be used to create partially-applied functions:

```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};

$sayHello = Dash\partial($greet, 'Hello');
$sayHowdy = Dash\partial($greet, 'Howdy');

$sayHello('Mark');  // === 'Hello, Mark!'
$sayHowdy('Jane');  // === 'Howdy, Jane!'
```

### Lazy evaluation

Chained operations are not evaluated until `value()` or `run()` is called. Furthermore, the input data can be changed and evaluated multiple times using `with()`. This makes it simple to create reusable chains:

```php
$chain = Dash\chain()
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; });

$chain->with([1, 2, 3])->value();  // === [2, 6]
$chain->with([4, 5, 6, 7])->value();  // === [10, 14]
```

Chains can also be cloned and extended:

```php
// …continued from above
$clone = clone $chain;
$clone->map(function ($n) { $n + 1; })
$clone->value();  // === [11, 15]

// The original chain is untouched
$chain->value();  // === [10, 14]
```

When `value()` is called, the result is cached until the chain is modified or the input is changed using `with()`.

### Custom operations

Custom operations can be added, retrieved, and removed using `setCustom()`, `getCustom()`, and `unsetCustom()`, respectively. `Dash\custom()` is also an alias for `Dash::getCustom()`:

```php
Dash::setCustom('triple', function ($n) { return $n * 3; });

// Standalone
Dash::triple(4);  // === 12

// Chained
Dash\chain([1, 2, 3])
	->sum()
	->triple()
	->value();  // === 18

// As an argument
Dash\chain([1, 2, 3])
	->map('Dash\Dash::triple')
	->value();  // === [3, 6, 9]

// As an argument using the Dash::getCustom() method
Dash\chain([1, 2, 3])
	->map(Dash::getCustom('triple'))
	->value();  // === [3, 6, 9]

// Using the Dash\custom() operation
Dash\chain([1, 2, 3])
	->map(Dash\custom('triple'))
	->value();  // === [3, 6, 9]

Dash::unsetCustom('triple');
```

When chained, the current input is passed as the first parameter to the custom operation:

```php
Dash::setCustom('divide', function($numerator, $denominator) { return $numerator / $denominator; });

Dash\chain(6)->divide(2)->value();  // === 2
```

### Tips

If you find that Dash doesn't have an operation that you need, fear not. Custom logic can be added without giving up Dash chaining or other features. The simplest way to integrate missing operations is via the [`Dash\thru()`](docs/Operations.md#thru) operation, which allows custom logic to modify and seamlessly pass through its results to the next step in the chain.

For example, suppose we want to use `array_change_key_case()` and keep the usual Dash chaining semantics. With `thru()`, it's simple:

```php
$result = Dash\chain(['one' => 1, 'two' => 2, 'three' => 3])
	->filter('Dash\isOdd')
	->thru(function($input) {
		return array_change_key_case($input, CASE_UPPER);
	})
	->keys()
	->value();

// $result === ['ONE', 'THREE']
```

Alternatively, if you find yourself needing to use `array_change_key_case()` often, it may be better to add a new custom operation:

```php
Dash::setCustom('keyCase', function ($input, $case) {
	return array_change_key_case($input, $case);
});
```

which you can then use like any other chainable Dash method:

```php
$result = Dash\chain(['one' => 1, 'two' => 2, 'three' => 3])
	->filter('Dash\isOdd')
	->keyCase(CASE_UPPER)
	->keys()
	->value();

// $result === ['ONE', 'THREE']
```

### Feedback

Found a bug or have a suggestion? Please [create a new GitHub issue](https://github.com/mpetrovich/dash/issues/new). We want your feedback!
