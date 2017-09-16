Dash &nbsp; [![Latest Stable Version](https://poser.pugx.org/mpetrovich/dash/version)](https://packagist.org/packages/mpetrovich/dash) [![Build Status](https://travis-ci.org/mpetrovich/Dash.svg?branch=master)](https://travis-ci.org/mpetrovich/Dash) [![codecov](https://codecov.io/gh/mpetrovich/Dash/branch/master/graph/badge.svg)](https://codecov.io/gh/mpetrovich/Dash)
===
A functional programming library for PHP. Inspired by Underscore, Lodash, and Ramda.

```php
$result = __([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();

// $result === [2, 6, 10]
```

[**See all available operations**](DOCS.md)

##### Jump to:
- [Features](#features)
- [Supported operations](DOCS.md)
- [Installation](#installation)
- [Usage](#usage)
- [Changelog](CHANGELOG.md)
- [Contributing](CONTRIBUTING.md)


Features
---
- Works with arrays, objects, [`Traversable`](http://php.net/manual/en/class.traversable.php), [`DirectoryIterator`](http://php.net/manual/en/class.directoryiterator.php), and more
- [Standalone operations](#standalone)
- [Chaining](#chaining)
- [Lazy evaluation](#lazy-evaluation)
- [Custom operations](#custom-operations)


Installation
---
Requires PHP 5.4+
```sh
composer require mpetrovich/dash
```


Usage
---
Dash operations can be used alone or chained together.


### Standalone
As static methods:

```php
use Dash\_;

_::map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

or a namespaced functions:

```php
Dash\map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```


### Chaining
Multiple operations can be chained in sequence using `chain()`. Call `value()` to return the final value. To explicitly convert the value to an array or `stdClass`, use `arrayValue()` or `objectValue()`.

```php
$result = _::chain([1, 2, 3, 4, 5])
	->filter('Dash\isOdd')
	->map(function ($n) { return $n * 2; })
	->value();

// $result === [2, 6, 10]
```

For convenience, `_::chain()` can be aliased to a global function via `addGlobalAlias()`. It only needs to be called once during your application bootstrap:

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


### Lazy evaluation
Chained operations are not evaluated until `value()` or `run()` is called. Furthermore, the input data can be changed and evaluated multiple times via `with()`. This makes it simple to create reusable chains:

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

When `value()` is called, the result is cached until the chain is modified or the input is changed via `with()`.


### Custom operations
Custom operations can be added and removed via `setCustom()` and `unsetCustom()`, respectively:

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
