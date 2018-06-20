Dash &nbsp; [![Latest Stable Version](https://poser.pugx.org/nextbigsoundinc/dash/version)](https://packagist.org/packages/nextbigsoundinc/dash) [![Build Status](https://travis-ci.org/nextbigsoundinc/dash.svg?branch=master)](https://travis-ci.org/nextbigsoundinc/dash) [![codecov](https://codecov.io/gh/nextbigsoundinc/dash/branch/master/graph/badge.svg)](https://codecov.io/gh/nextbigsoundinc/dash)
===
A functional programming library for PHP. Inspired by Underscore, Lodash, and Ramda.

```php
$result = __([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();

// $result === [2, 6, 10]
```

##### Jump to:
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Operations](DOCS.md)
- [Changelog](CHANGELOG.md)
- [Contributing](CONTRIBUTING.md)


Features
---
- Works with arrays, objects, [`Traversable`](http://php.net/manual/en/class.traversable.php), [`DirectoryIterator`](http://php.net/manual/en/class.directoryiterator.php), and more
- [Chaining](#chaining)
- [Currying](#currying)
- [Lazy evaluation](#lazy-evaluation)
- [Custom operations](#custom-operations)


Installation
---
Requires PHP 5.4+
```sh
composer require nextbigsoundinc/dash
```


Usage
---
Dash operations can be used alone or chained together. [**See the full list of operations**](DOCS.md)


### Standalone
Operations can be called as static methods:

```php
use Dash\_;

_::map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

or as namespaced functions:

```php
Dash\map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```


### Chaining
Multiple operations can be chained in sequence using `chain()`. Call `value()` to return the final value.

```php
$result = _::chain([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();

// $result === [2, 6, 10]
```

To explicitly convert the value to an array or `stdClass`, use `arrayValue()` or `objectValue()` respectively:

```php
$result = _::chain(['a' => 1, 'b' => 2, 'c' => 3])
	->filter('Dash\isOdd')
	->mapValues(function ($n) { return $n * 2; })
	->objectValue();

// $result === (object) ['a' => 2, 'c' => 6]
```

For convenience, `_::chain()` can be aliased to a global function using `addGlobalAlias()`. It only needs to be called once during your application bootstrap:

```php
// In your application bootstrap:
_::addGlobalAlias('__');

// Elsewhere:
$result = __([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();
```

Sometimes you don't need the return value of the chain. However, the chain isn't processed until `value()` is called. For semantic convenience, `run()` is also an alias for `value()`:

```php
$chain = _::chain([1, 2, 3, 4, 5])
	->reverse()
	->each(function ($n) {
		echo "T-minus $n...\n";
		sleep(1);
	});

// Nothing echoed yet

$chain->value();
// or
$chain->run();

// Now it starts...
```


### Currying

[`curry()`](DOCS.md#curry) and related operations can be used to create curried functions from any callable:

```php
function listThree($a, $b, $c) {
	return "$a, $b, and $c";
}

$listThree = Dash\curry('listThree');
$listTwo = $listThree('first');
$listTwo('second', 'third');
// === 'first, second, and third'
```

All Dash functions have a curried variant that accepts input data as the last parameter instead of as the first. The name of the curried function is the same as the uncurried function name but prefixed with an underscore, `_`:

```php
_::chain(['a' => 3, 'b' => '3', 'c' => 3, 'd' => 3.0])
	->filter(Dash\_identical(3))
	->value();
// === ['a' => 3, 'c' => 3]
```

Similarly, [`partial()`](DOCS.md#partial) and related operations can be used to create partially-applied functions:

```php
$containsTruthy = Dash\_contains(true, 'Dash\equal');
$containsTruthy([0, 1, 0]);
// === true

$containsTrue = Dash\_contains(true, 'Dash\identical');
$containsTrue([0, 1, 0]);
// === false
```


### Lazy evaluation
Chained operations are not evaluated until `value()` or `run()` is called. Furthermore, the input data can be changed and evaluated multiple times using `with()`. This makes it simple to create reusable chains:

```php
$chain = _::chain()
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
Custom operations can be added and removed using `setCustom()` and `unsetCustom()`, respectively:

```php
_::setCustom('triple', function ($n) { return $n * 3; });

// Standalone
_::triple(4);  // === 12

// Chained
_::chain([1, 2, 3])
	->map('Dash\_::triple')
	->value();  // === [3, 6, 9]

// Chained (alternative syntax)
_::chain([1, 2, 3])
	->map(Dash\custom('triple'))
	->value();  // === [3, 6, 9]

_::unsetCustom('triple');
```
