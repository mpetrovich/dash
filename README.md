Dash
====
A functional utility library for PHP.

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Documentation](docs/index.html)
- [Changelog](CHANGELOG.md)
- [Contributing](CONTRIBUTING.md)


Features
--------
- Supports a variety of data types:
	- native PHP arrays
	- [`stdClass`](http://php.net/manual/en/reserved.classes.php) objects
	- [`Traversable`](http://php.net/manual/en/class.traversable.php) objects (e.g. [`ArrayObject`](http://php.net/manual/en/class.arrayobject.php), [Propel ORM models](http://www.propelorm.org))
- [Standalone usage](#standalone-usage) and [chaining](#chaining)
- [Deferred evaluation](#deferred-evaluation)
- Comprehensive unit tests
- Modular architecture
- Works with PHP 5.3+


Requirements
------------
- PHP 5.3+
- [Composer](https://getcomposer.org/)


Installation
------------
Dash should be installed via [Composer](https://getcomposer.org/):
```sh
composer require mpetrovich/dash
```


Usage
-----
All classes and functions are available within the `Dash` namespace or one of its child namespaces, which include:

- `Dash\Collections`
- `Dash\Functions`


#### Standalone usage
Standalone operations can be called alone:

```php
$double = Dash\Collections\map(
	array(1, 2, 3),
	function($n) { return $n * 2; }
);

// $double == array(2, 4, 6)
```


#### Chaining
Multiple operations can be chained in sequence using `with()`:

```php
$doubleOdds = Dash\Dash::with(array(1, 2, 3))
	->filter('Dash\Functions\isOdd')
	->map(function($n) { return $n * 2; })
	->value();

// $doubleOdds == array(2, 6)
```


#### Deferred evaluation
Chained operations are not evaluated until `value()` is called, so the input data can be changed at any time before then. This makes it simple to create reusable chains:
```php
$doubleOdds = Dash\Dash::with()
	->filter('Dash\Functions\isOdd')
	->map(function($n) { return $n * 2; });

$result = $doubleOdds->with(array(1, 2, 3))->value();
// $result == array(2, 6)

$result = $doubleOdds->with(array(7, 9, 11, 13))->value();
// $result == array(14, 18, 22, 26)
```


#### Included operations
For collections (arrays, `stdClass` and `Traversable` objects):

- `Collections\any()`
- `Collections\at()`
- `Collections\average()`
- `Collections\contains()`
- `Collections\deltas()`
- `Collections\difference()`
- `Collections\each()`
- `Collections\every()`
- `Collections\filter()`
- `Collections\find()`
- `Collections\findKey()`
- `Collections\findLast()`
- `Collections\findValue()`
- `Collections\first()`
- `Collections\get()`
- `Collections\intersection()`
- `Collections\isEmpty()`
- `Collections\keys()`
- `Collections\last()`
- `Collections\map()`
- `Collections\mapValues()`
- `Collections\matches()`
- `Collections\matchesProperty()`
- `Collections\max()`
- `Collections\median()`
- `Collections\min()`
- `Collections\pluck()`
- `Collections\property()`
- `Collections\reduce()`
- `Collections\reject()`
- `Collections\reverse()`
- `Collections\size()`
- `Collections\sort()`
- `Collections\sum()`
- `Collections\take()`
- `Collections\takeRight()`
- `Collections\thru()`
- `Collections\toArray()`
- `Collections\union()`
- `Collections\values()`
- `Collections\where()`
- `Collections\without()`

For functions & scalar values:

- `Functions\compare()`
- `Functions\equal()`
- `Functions\identical()`
- `Functions\identity()`
- `Functions\isEven()`
- `Functions\isOdd()`
- `Functions\negate()`
- `Functions\partial()`
- `Functions\partialRight()`
