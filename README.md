Dash &nbsp; [![Build Status](https://travis-ci.org/mpetrovich/Dash.svg?branch=master)](https://travis-ci.org/mpetrovich/Dash)
====
A functional utility library for PHP, like Underscore/Lodash.

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Documentation](docs/index.html)
- [Changelog](CHANGELOG.md)
- [Contributing](CONTRIBUTING.md)


Features
--------
- Works with PHP 5.4+
- Supports a variety of data types:
	- native PHP arrays
	- [`stdClass`](http://php.net/manual/en/reserved.classes.php) objects
	- [`Traversable`](http://php.net/manual/en/class.traversable.php) objects such as [`ArrayObject`](http://php.net/manual/en/class.arrayobject.php) and many database ORM models
- [Chaining](#chaining)
- [Deferred evaluation](#deferred-evaluation)
- Comprehensive unit tests
- Modular architecture


Requirements
------------
- PHP 5.4+
- [Composer](https://getcomposer.org/)


Installation
------------
Dash should be installed via [Composer](https://getcomposer.org/):
```sh
composer require mpetrovich/dash
```


Usage
-----
All classes and functions are available within the `Dash` namespace.


#### One-off operations
Standalone operations can be called alone:

```php
use Dash\_;

$double = _::map(
	array(1, 2, 3),
	function($n) { return $n * 2; }
);

// $double == array(2, 4, 6)
```


#### Chaining
Multiple operations can be chained in sequence using `chain()`. Use `value()` to retrieve the final value:

```php
use Dash\_;

$doubleOdds = _::chain([1, 2, 3])
	->filter('Dash\_::isOdd')
	->map(function($n) { return $n * 2; })
	->value();

// $doubleOdds == [2, 6]
```

As a convenience, `_::chain()` can be aliased to a global function with `setGlobalAlias()`:

```php
Dash\_::setGlobalAlias('__');

$doubleOdds = __([1, 2, 3])
	->filter('Dash\_::isOdd')
	->map(function($n) { return $n * 2; })
	->value();

// $doubleOdds == [2, 6]
```


#### Deferred evaluation
Chained operations are not evaluated until `value()` is called, so the input data can be changed at any time (via `with()`) before then. This makes it simple to create reusable chains:

```php
use Dash\_;

$doubleOdds = _::chain()
	->filter('Dash\_::isOdd')
	->map(function($n) { return $n * 2; });

$result = $doubleOdds->with(array(1, 2, 3))->value();
// $result == array(2, 6)

$result = $doubleOdds->with(array(7, 9, 11, 13))->value();
// $result == array(14, 18, 22, 26)
```


#### Custom functions
Custom functions can be added and removed via `setCustom()` and `unsetCustom()`, respectively:

```php
use Dash\_;

_::setCustom('triple', function($value) {
	return $value * 3;
});

_::triple(4)); // === 12
_::chain(5)->triple()->value(); // === 15

_::unsetCustom('triple');
```


#### Included operations

 - `all()`
 - `any()`
 - `assertType()`
 - `at()`
 - `average()`
 - `compare()`
 - `contains()`
 - `deltas()`
 - `difference()`
 - `each()`
 - `equal()`
 - `every()`
 - `filter()`
 - `find()`
 - `findKey()`
 - `findLast()`
 - `findValue()`
 - `first()`
 - `get()`
 - `groupBy()`
 - `identical()`
 - `identity()`
 - `indexBy()`
 - `intersection()`
 - `isEmpty()`
 - `isEven()`
 - `isOdd()`
 - `keyBy()`
 - `keys()`
 - `last()`
 - `map()`
 - `mapValues()`
 - `matches()`
 - `matchesProperty()`
 - `max()`
 - `median()`
 - `min()`
 - `negate()`
 - `partial()`
 - `partialRight()`
 - `pick()`
 - `pluck()`
 - `property()`
 - `reduce()`
 - `reject()`
 - `reverse()`
 - `set()`
 - `size()`
 - `sort()`
 - `sum()`
 - `take()`
 - `takeRight()`
 - `tap()`
 - `thru()`
 - `toArray()`
 - `union()`
 - `values()`
 - `where()`
 - `without()`
