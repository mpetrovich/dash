Dash &nbsp; [![Latest Stable Version](https://poser.pugx.org/nextbigsoundinc/dash/version)](https://packagist.org/packages/nextbigsoundinc/dash) [![Build Status](https://travis-ci.org/nextbigsoundinc/dash.svg?branch=master)](https://travis-ci.org/nextbigsoundinc/dash) [![codecov](https://codecov.io/gh/nextbigsoundinc/dash/branch/master/graph/badge.svg)](https://codecov.io/gh/nextbigsoundinc/dash)
===
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

At a glance
---
#### Jump to:
- [Why use Dash?](#why-use-dash)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Operations](docs/Operations.md)
- [Changelog](https://github.com/nextbigsoundinc/dash/releases)
- [Contributing](CONTRIBUTING.md)

#### Iterable
[all / every](docs/Operations.md#all--every),
[any / some](docs/Operations.md#any--some),
[at](docs/Operations.md#at),
[average / mean](docs/Operations.md#average--mean),
[contains / includes](docs/Operations.md#contains--includes),
[deltas](docs/Operations.md#deltas),
[difference](docs/Operations.md#difference),
[each](docs/Operations.md#each),
[filter](docs/Operations.md#filter),
[find](docs/Operations.md#find),
[findKey](docs/Operations.md#findkey),
[findLast](docs/Operations.md#findlast),
[findLastKey](docs/Operations.md#findlastkey),
[findLastValue](docs/Operations.md#findlastvalue),
[findValue](docs/Operations.md#findvalue),
[first / head](docs/Operations.md#first--head),
[groupBy](docs/Operations.md#groupby),
[intersection](docs/Operations.md#intersection),
[isIndexedArray](docs/Operations.md#isindexedarray),
[join / implode](docs/Operations.md#join--implode),
[keyBy / indexBy](docs/Operations.md#keyby--indexby),
[keys](docs/Operations.md#keys),
[last](docs/Operations.md#last),
[map](docs/Operations.md#map),
[mapValues](docs/Operations.md#mapvalues),
[matchesProperty](docs/Operations.md#matchesproperty),
[max](docs/Operations.md#max),
[median](docs/Operations.md#median),
[min](docs/Operations.md#min),
[omit](docs/Operations.md#omit),
[pick](docs/Operations.md#pick),
[pluck](docs/Operations.md#pluck),
[property](docs/Operations.md#property),
[reduce](docs/Operations.md#reduce),
[reject](docs/Operations.md#reject),
[reverse](docs/Operations.md#reverse),
[rotate](docs/Operations.md#rotate),
[sort](docs/Operations.md#sort),
[sum](docs/Operations.md#sum),
[take](docs/Operations.md#take),
[takeRight](docs/Operations.md#takeright),
[toArray](docs/Operations.md#toarray),
[toObject](docs/Operations.md#toobject),
[union](docs/Operations.md#union),
[values](docs/Operations.md#values)

#### Utility
[assertType](docs/Operations.md#asserttype),
[chain](docs/Operations.md#chain),
[compare](docs/Operations.md#compare),
[custom](docs/Operations.md#custom),
[debug](docs/Operations.md#debug),
[equal](docs/Operations.md#equal),
[get](docs/Operations.md#get),
[getDirect](docs/Operations.md#getdirect),
[getDirectRef](docs/Operations.md#getdirectref),
[hasDirect](docs/Operations.md#hasdirect),
[identical](docs/Operations.md#identical),
[identity](docs/Operations.md#identity),
[isEmpty](docs/Operations.md#isempty),
[isType](docs/Operations.md#istype),
[result](docs/Operations.md#result),
[set](docs/Operations.md#set),
[size / count](docs/Operations.md#size--count),
[tap](docs/Operations.md#tap),
[thru](docs/Operations.md#thru)

#### Callable
[apply](docs/Operations.md#apply),
[ary](docs/Operations.md#ary),
[call](docs/Operations.md#call),
[currify](docs/Operations.md#currify),
[currifyN](docs/Operations.md#currifyn),
[curry](docs/Operations.md#curry),
[curryN](docs/Operations.md#curryn),
[curryRight](docs/Operations.md#curryright),
[curryRightN](docs/Operations.md#curryrightn),
[negate](docs/Operations.md#negate),
[partial](docs/Operations.md#partial),
[partialRight](docs/Operations.md#partialright),
[unary](docs/Operations.md#unary)

#### Number
[isEven](docs/Operations.md#iseven),
[isOdd](docs/Operations.md#isodd)


Why use Dash?
---
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

Using PHP's built-in in methods, we might write something like this:

```php
$males = array_filter($people, function ($person) {
	return $person['gender'] === 'male';
});
$avgMaleAge = array_sum(array_column($males, 'age')) / count($males);
```

Dash makes common data transformation operations like these clearer and more fluid:

```php
$avgMaleAge = Dash\chain($people)
	->filter(['gender', 'male'])
	->map('age')
	->average()
	->value();
```

This is just a tiny subset of what Dash can do. [**See the full list of operations here.**](docs/Operations.md)


Features
---
- Works with arrays, objects, [`Traversable`](http://php.net/manual/en/class.traversable.php), [`DirectoryIterator`](http://php.net/manual/en/class.directoryiterator.php), and more
- [Chaining](#chaining)
- [Currying](#currying)
- [Lazy evaluation](#lazy-evaluation)
- [Custom operations](#custom-operations)
- Comprehensive tests with over 2000 test cases


Installation
---
Requires PHP 5.4+
```sh
composer require nextbigsoundinc/dash
```


Usage
---
Dash operations are pure functions that can be used alone or chained together.


### Standalone
Operations can be called as namespaced functions:

```php
Dash\map([1, 2, 3], function ($n) { return $n * 2; });  // === [2, 4, 6]
```

or as static methods:

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
$chain = Dash\chain([1, 2, 3, 4, 5])
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

[`curry()`](docs/Operations.md#curry) and related operations can be used to create curried functions from any callable:

```php
function listThree($a, $b, $c) {
	return "$a, $b, and $c";
}

$listThree = Dash\curry('listThree');
$listTwo = $listThree('first');
$listTwo('second', 'third');
// === 'first, second, and third'
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
$containsTruthy = Dash\Curry\contains(true, 'Dash\equal');
$containsTruthy([0, 1, 0]);
// === true

$containsTrue = Dash\Curry\contains(true, 'Dash\identical');
$containsTrue([0, 1, 0]);
// === false
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
Custom operations can be added and removed using `setCustom()` and `unsetCustom()`, respectively:

```php
_::setCustom('triple', function ($n) { return $n * 3; });

// Standalone
_::triple(4);  // === 12

// Chained
Dash\chain([1, 2, 3])
	->map('Dash\_::triple')
	->value();  // === [3, 6, 9]

// Chained (alternative syntax)
Dash\chain([1, 2, 3])
	->map(Dash\custom('triple'))
	->value();  // === [3, 6, 9]

_::unsetCustom('triple');
```


### Feedback
Found a bug or have a suggestion? Please [create a new GitHub issue](https://github.com/nextbigsoundinc/dash/issues/new). We want your feedback!
