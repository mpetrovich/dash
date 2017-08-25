Table of contents
===
### Iterable
- [all](#all--every) / every
- [any](#any)
- [average](#average)
- [contains](#contains)
- [deltas](#deltas)
- [difference](#difference)
- [dropWhile](#dropwhile)
- [each](#each)
- [filter](#filter)
- [find](#find)
- [findKey](#findkey)
- [findLast](#findlast)
- [findValue](#findvalue)
- [first](#first)
- [get](#get)
- [getDirect](#getdirect)
- [getDirectRef](#getdirectref)
- [groupBy](#groupby)
- [hasDirect](#hasdirect)
- [intersection](#intersection)
- [isEmpty](#isempty)
- [join](#join)
- [keyBy](#keyby--indexby) / indexBy
- [keys](#keys)
- [last](#last)
- [map](#map)
- [mapValues](#mapvalues)
- [max](#max)
- [median](#median)
- [min](#min)
- [pluck](#pluck)
- [property](#property)
- [union](#union)
- [values](#values)

### Function
- [apply](#apply)
- [ary](#ary)
- [call](#call)

### Utility
- [assertType](#asserttype)
- [compare](#compare)
- [display](#display)
- [equal](#equal)
- [identical](#identical)
- [identity](#identity)
- [is](#is)

### Array
- [at](#at)
- [isIndexedArray](#isindexedarray)

### Dash
- [chain](#chain)
- [custom](#custom)

### Number
- [isEven](#iseven)
- [isOdd](#isodd)

### Other
- [matches](#matches)
- [matchesProperty](#matchesproperty)
- [partial](#partial)
- [partialRight](#partialright)
- [pick](#pick)
- [reduce](#reduce)
- [reject](#reject)
- [result](#result)
- [reverse](#reverse)
- [set](#set)
- [size](#size)
- [sort](#sort)
- [sum](#sum)
- [take](#take)
- [takeRight](#takeright)
- [takeWhile](#takewhile)
- [tap](#tap)
- [thru](#thru)
- [toArray](#toarray)
- [where](#where)
- [without](#without)

### Callable
- [negate](#negate)


Iterable
===

all / every
---
```php
all($iterable, $predicate): boolean
```
Checks whether $predicate returns truthy for every item in $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `mixed` | 
`$predicate` | `callable` | A callable invoked with ($value, $key) that returns a boolean


**Example:** 
```php
all([1, 2, 3], function($n) { return $n > 5; });  // === false
all([1, 3, 5], 'Dash\isOdd');  // === true
```
any
---
```php
any($iterable, $predicate): boolean
```
Checks whether $predicate returns truthy for any item in $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `mixed` | 
`$predicate` | `callable` | A callable invoked with ($value, $key) that returns a boolean


**Example:** 
```php
all([1, 2, 3], function($n) { return $n > 5; });  // === false
all([1, 2, 3], 'Dash\isEven');  // === true
```
average
---
```php
average($iterable): double
```
Gets the average of all values in $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
average([2, 3, 5, 8]);  // === 4.5
```
contains
---
```php
contains($iterable, $target, $comparator = 'Dash\equal'): boolean
```
Checks whether $iterable has any elements for which $comparator($target, $element) is truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$target` | `mixed` | Value to compare $iterable elements against
`$comparator` | `callable` | Invoked with ($target, $element) for each $element value in $iterable


**Example:** With loose equality comparison (the default)
```php
contains([1, '2', 3], 2);  // === true

```

**Example:** With strict equality comparison
```php
contains([1, '2', 3], 2, 'Dash\identity');  // === false
```
deltas
---
```php
deltas($iterable): array
```
Returns a new array whose values are the differences between subsequent elements of a iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
deltas([3, 8, 9, 9, 5, 13]);  // === [0, 5, 1, 0, -4, 8]
```
difference
---
```php
difference($iterable /* , ...iterables */): array
```
Returns a subset of items from the first iterable that are not present in any of the other iterables.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | Iterable to compare against
`$iterables,...` | `iterable` | 


**Example:** 
```php
diff(
	[1, 2, 3, 4, 5, 6],
	[1, 3, 5],
	[2, 8]
);  // === [4, 6]
```
dropWhile
---
```php
dropWhile($iterable, $predicate = 'Dash\identity'): array
```
Returns a subset of $iterable that excludes elements from the beginning.
Elements are dropped until $predicate returns falsey.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Invoked with ($value, $key, $iterable)



each
---
```php
each($iterable, $iteratee): mixed
```
Iterates over a collection and calls an iteratee function for each element.

Any changes to the value, key, or collection from within the iteratee function are not persisted.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$iteratee` | `callable` | Invoked with ($value, $key, $iterable) for each element in $iterable. If $iteratee returns false, iteration will end and subsequent elements will be skipped.


**Example:** 
```php
each([1, 2, 3], function ($value, $index, $array) { // $array[$index] === $value });
```
filter
---
```php
filter($iterable, $predicate): array
```
Returns a subset of $iterable for which $predicate is truthy. Keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Callable invoked with ($value, $key, $iterable) for each item in $iterable


**Example:** 
```php
filter([1, 2, 3, 4], function ($n) { return $n > 2; });  // === [3, 4]
filter([1, 2, 3, 4], 'Dash\isEven');  // === [2, 4]

```

**Example:** With matchesProperty() shorthand
```php
filter([
	['name' => 'abc', 'active' => false],
	['name' => 'def', 'active' => true],
	['name' => 'ghi', 'active' => true],
], 'active');
// === [
	['name' => 'def', 'active' => true],
	['name' => 'ghi', 'active' => true]
]
```
find
---
```php
find($iterable, $predicate): array|null
```
Returns the key & value of the first element for which $predicate returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable\|mixed` | Value to compare against, or callable invoked with ($value, $key, $iterable)


**Example:** With comparison value
```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
find($array, 3);  // === ['c', 3]
find($array, 'Dash\isEven');  // === ['b', 2]
```
findKey
---
```php
findKey($iterable, $predicate): string|integer|null
```
Returns the key of the first element for which $predicate returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable\|mixed` | Value to compare against, or callable invoked with ($value, $key, $iterable)


**Example:** With comparison value
```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
find($array, 3);  // === 'c'
find($array, 'Dash\isEven');  // === 'b'
```
findLast
---
```php
findLast($iterable, $predicate): array|null
```
Returns the key & value of the last element for which $predicate returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable\|mixed` | Value to compare against, or callable invoked with ($value, $key, $iterable)


**Example:** With comparison value
```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
find($array, 3);  // === ['c', 3]
find($array, 'Dash\isEven');  // === ['d', 4]
```
findValue
---
```php
findValue($iterable, $predicate): string|integer|null
```
Returns the value of the first element for which $predicate returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable\|mixed` | Value to compare against, or callable invoked with ($value, $key, $iterable)


**Example:** With comparison value
```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
find($array, 3);  // === 3
find($array, 'Dash\isEven');  // === 2
```
first
---
```php
first($iterable): mixed
```
Returns the first value of $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
first(['a' => '1st', 'b' => '2nd', 'c' => '3rd']);  // === '1st'
```
get
---
```php
get($iterable, $path, $default = null): mixed
```
Gets the value at a path on a collection.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$path` | `callable\|string` | Callable used to retrieve the value or path of the property to retrieve; Paths can be nested by delimiting each sub-property or array index with a period, eg. 'a.b.0.c'
`$default` | `mixed` | Default value to return if nothing exists at $path 


**Example:** 
```php
$iterable = [
	'a' => [
		'b' => 'value'
	]
];
Dash\get($iterable, 'a.b') == 'value';

```

**Example:** Array elements can be referenced by index
```php
$iterable = [
	'people' => [
		['name' => 'Pete'],
		['name' => 'John'],
		['name' => 'Paul'],
	]
];
Dash\get($iterable, 'people.1.name') == 'John';

```

**Example:** Keys with the same name as the full path can be used
```php
$iterable = ['a.b.c' => 'value'];
Dash\get($iterable, 'a.b.c') == 'value';
```
getDirect
---
```php
getDirect($iterable, $key, $default = null): mixed
```
Gets the value at the given key of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$key` | `string` | 
`$default` | `mixed` | Value to return if no value at $key exists


**Example:** With an array
```php
getDirect(['a' => 'one', 'b' => 'two'], 'b');  // === 'two'

```

**Example:** With an object
```php
getDirect((object) ['a' => 'one', 'b' => 'two'], 'b');  // === 'two'
```
getDirectRef
---
```php
: mixed
```
Like getDirect(), but returns a reference to the value at the given key of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$key` | `string` | 



groupBy
---
```php
groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array
```
Groups elements by the common values generated by an iteratee.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$iteratee` | `callable` | (optional) Invoked with ($element) for each element of $iterable
`$defaultGroup` | `string` | (optional) Elements with null $iteratee return values will be in this group


**Example:** 
```php
groupBy([1, 2, 3, 4, 5], 'Dash\isOdd');
// === [true => [1, 3, 5], false => [2, 4]]

```

**Example:** 
```php
groupBy([2.1, 2.5, 3.5, 3.9, 4], 'Dash\isOdd');
// === [2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4]]
```
hasDirect
---
```php
hasDirect($iterable, $key): boolean
```
Checks whether an iterable has a value at a given key.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object\|ArrayAccess` | 
`$key` | `string` | 


**Example:** 
```php
hasDirect(['a' => ['b' => 1, 'c' => 2], 'a');  // === true
hasDirect(['a' => ['b' => 1, 'c' => 2], 'b');  // === false

```

**Example:** 
```php
hasDirect((object) ['a' => 1, 'b' => 2], 'b');  // === true
```
intersection
---
```php
intersection($iterable /* , ...iterables */): array
```
Returns a new array containing values of $iterable that are present in all other arguments.

Iterable keys are preseved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | Iterable to compare against
`$iterables,...` | `iterable` | 


**Example:** 
```php
intersection(
	[1, 3, 5, 8],
	[1, 2, 3, 4]
);  // === [0 => 1, 1 => 3]
```
isEmpty
---
```php
isEmpty($input): boolean
```
Checks whether a value is an empty iterable or value.

A value is empty if it is an iterable of size zero or loosely equals false.

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 


**Example:** 
```php
isEmpty([]);                 // === true
isEmpty(new ArrayObject());  // === true
isEmpty('');                 // === true
isEmpty(0);                  // === true
isEmpty([0]);                // === false
```
join
---
```php
join($iterable, $separator): string
```
Concatenates all elements in $iterable to a string, each separated by $separator.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$separator` | `string` | 


**Example:** 
```php
join([123, 456, 789], '-');  // === '123-456-789'
```
keyBy / indexBy
---
```php
keyBy($iterable, $iteratee = 'Dash\identity'): array
```
Keys elements by the common values generated by an iteratee.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$iteratee` | `callable` | (optional) Invoked with ($element) for each element of $iterable


**Example:** 
```php
keyBy([
	['name' => 'John', 'gender' => 'male'],
	['name' => 'Alice', 'gender' => 'female'],
	['name' => 'Jane', 'gender' => 'female'],
	['name' => 'Peter', 'gender' => 'male'],
	['name' => 'Fred', 'gender' => 'male'],
], 'name');
// === [
	'John'  => ['name' => 'John', 'gender' => 'male'],
	'Alice' => ['name' => 'Alice', 'gender' => 'female'],
	'Jane'  => ['name' => 'Jane', 'gender' => 'female'],
	'Peter' => ['name' => 'Peter', 'gender' => 'male'],
	'Fred'  => ['name' => 'Fred', 'gender' => 'male'],
]
```
keys
---
```php
keys($iterable): array
```
Gets the keys of an iterable as an array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
keys(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]);
// === ['a', 'b', 'c', 'd']
```
last
---
```php
last($iterable): mixed
```
Returns the last value of $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
last(['a' => '1st', 'b' => '2nd', 'c' => '3rd']);  // === '3rd'
```
map
---
```php
map($iterable, $iteratee = 'Dash\identity'): array
```
Creates a new indexed array of values by running each element in a
collection through an iteratee function.

Keys in the original collection are _not_ preserved; a freshly indexed array
is returned.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$iteratee` | `Callable\|string` | Function called with (element, key, collection) for each element in $iterable. The return value of $iteratee will be used as the corresponding element in the returned array. If $iteratee is a string, property($iteratee) will be used as the iteratee function. 


**Example:** 
```php
Dash\map(
	[1, 2, 3],
	function($n) {
		return $n * 2;
	}
) == [2, 4, 6];

```

**Example:** 
```php
Dash\map(
	['roses' => 'red', 'violets' => 'blue'],
	function($color, $flower) {
		return $flower . ' are ' . $color;
	}
) == ['roses are red', 'violets are blue'];

```

**Example:** With $iteratee as a path
```php
Dash\map(
	['color' => 'red', 'color' => 'blue'],
	'color'
) == ['red', 'blue'];
```
mapValues
---
```php
mapValues($iterable, $iteratee = 'Dash\identity'): array
```
Creates a new array of values by running each element in a collection
through an iteratee function.

Keys in the original collection _are_ preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$iteratee` | `Callable` | Function called with (element, key, collection) for each element in $iterable. The return value of $iteratee will be used as the corresponding element in the returned array. 


**Example:** 
```php
Dash\map(
	[1, 2, 3],
	function($n) { return $n * 2; }
) == [2, 4, 6];

```

**Example:** 
```php
Dash\map(
	['roses' => 'red', 'violets' => 'blue'],
	function($color, $flower) { return $flower . ' are ' . $color; }
) == ['roses' => 'roses are red', 'violets' => 'violets are blue'];
```
max
---
```php
max($iterable): mixed|null
```
Returns the maximum value of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
max([3, 8, 2, 5]);  // === 8
```
median
---
```php
median($iterable): mixed|null
```
Returns the median value of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
median([3, 8, 2, 5]);  // === 4
```
min
---
```php
min($iterable): mixed|null
```
Returns the minimum value of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
min([3, 8, 2, 5]);  // === 2
```
pluck
---
```php
pluck($iterable, $path, $default = null): array
```
Gets the value at a path for all elements in a collection.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$path` | `string` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period
`$default` | `mixed` | 


**Example:** 
```php
Dash\pluck(
	[
		['a' => ['b' => 1]],
		['a' => 'missing'],
		['a' => ['b' => 3]],
		['a' => ['b' => 4]],
	],
	'a.b',
	'default'
) == [1, 'default', 3, 4];
```
property
---
```php
property($path, $default = null): function
```
Creates a function that returns the value at a path on a collection.


Parameter | Type | Description
--- | --- | :---
`$path` | `string\|function` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period. If it is already a function, the same function is returned.
`$default` | `mixed` | Default value to return if nothing exists at $path


**Example:** 
```php
$getter = property('a.b');
$iterable = [
	'a' => [
		'b' => 'value'
	]
];
$getter($iterable);  // === 'value';

```

**Example:** Array elements can be referenced by index
```php
$getter = property('people.1.name');
$iterable = [
	'people' => [
		['name' => 'Pete'],
		['name' => 'John'],
		['name' => 'Paul'],
	]
];
$getter($iterable) === 'John';

```

**Example:** Keys with the same name as the full path can be used
```php
$getter = property('a.b.c');
$iterable = ['a.b.c' => 'value'];
$getter($iterable);  // === 'value';
```
union
---
```php
union(/* ...iterables */): array
```
Returns a new array containing values of $iterable that are present in all other arguments.

Iterable keys are preseved.


Parameter | Type | Description
--- | --- | :---
`$iterables,...` | `iterable` | 


**Example:** 
```php
intersection(
	[1, 3, 5, 8],
	[1, 2, 3, 4]
);  // === [1, 3, 5, 8, 2, 4]
```
values
---
```php
values($iterable): array
```
Gets the values of an iterable as an array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 


**Example:** 
```php
values(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]);
// === [3, 8, 2, 5]
```

Function
===

apply
---
```php
apply($callable, $args): mixed
```
Invokes a callable with arguments passed as a list.

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$args` | `array` | 


**Example:** 
```php
$saveUser = function ($name, $email) { … };
apply($saveUser, ['John', 'jdoe@gmail.com']);
```
ary
---
```php
ary($callable, $ary): callable
```
Wraps $callable in a new function that only accepts up to $ary arguments and ignores the rest.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$ary` | `int` | Number of arguments to accept


**Example:** 
```php
$fileExists = ary('file_exists', 1);
$fileExists('foo.txt', 123, 456);  // file_exists() will only get called with 'foo.txt'
```
call
---
```php
call($callable /* , ...args */): mixed
```
Invokes a callable with arguments passed as individual parameters.

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 


**Example:** 
```php
$saveUser = function ($name, $email) { … };
call($saveUser, 'John', 'jdoe@gmail.com');
```

Utility
===

assertType
---
```php
assertType($input, $type): void
```
Throws an exception if $input's type is not $type.


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$type` | `string\|array` | Single type or list of types


**Example:** 
```php
$input = [1, 2, 3];
assertType($input, 'object');  // will throw
```
compare
---
```php
compare($a, $b): int
```
Returns -1, 0, +1 if $a is less than, equal to, or great than $b, respectively.


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 


**Example:** 
```php
compare(2, 3);  // === -1
compare(2, 1);  // === +1
compare(2, 2);  // === 0
```
display
---
```php
display($value): mixed
```
Prints a value.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 



equal
---
```php
equal($a, $b): boolean
```
Checks whether two values are loosely equal (same value, but types can be different).


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 


**Example:** 
```php
equal(3, '3');  // === true
equal(3, 3);    // === true

```

**Example:** 
```php
equal([1, 2, 3], [1, '2', 3]);  // === true
equal([1, 2, 3], [1, 2, 3]);    // === true
```
identical
---
```php
identical($a, $b): boolean
```
Checks whether two values are strictly equal (same value and type).


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 


**Example:** 
```php
identical(3, '3');  // === false
identical(3, 3);    // === true

```

**Example:** 
```php
identical([1, 2, 3], [1, '2', 3]);  // === false
identical([1, 2, 3], [1, 2, 3]);    // === true
```
identity
---
```php
identity($value): mixed
```
Returns the first argument it receives.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 


**Example:** 
```php
$a = new ArrayObject();
identity($a);  // === $a
```
is
---
```php
is($value, $type): boolean
```
Checks whether a value is of a particular data type.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | Value to check
`$type` | `string\|array` | Single type to check or a list of possible types; types can be: a native data type (eg. 'string', 'array'), a type corresponding to a native is_<type>() function (eg. 'numeric'), a class instance (eg. 'DateTime')


**Example:** With a native data type
```php
is([1, 2, 3], 'array');  // === true

```

**Example:** With a type corresponding to a native is_<type>() method
```php
is(3.14, 'numeric');  // === true

```

**Example:** 'iterable', in contrast with is_iterable(), returns true for stdClass objects
```php
$obj = (objec) [1, 2, 3];
is_iterable($obj);     // === false
is($obj, 'iterable');  // === true

```

**Example:** With a class instance
```php
is(new ArrayObject([1, 2, 3]), 'ArrayObject');  // === true
```

Array
===

at
---
```php
at($iterable, $index): mixed
```
Gets the value at the $index-th value of $iterable, ignoring key values.

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$index` | `int\|string` | 


**Example:** 
```php
at([1, 3, 5, 8], 2);  // === 5

```

**Example:** Keys are ignored; the literal i-th position is returned
```php
at([3 => 'a', 2 => 'b', 1 => 'c', 0 => 'd'], 2);  // === 'c'
```
isIndexedArray
---
```php
isIndexedArray($input): boolean
```
Returns whether $input is an array with sequential integer keys that start at 0.


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 


**Example:** 
```php
isIndexedArray([1, 2, 3]);             // === true
isIndexedArray(['a' => 1, 'b' => 2]);  // === false
```

Dash
===

chain
---
```php
chain($input = null): Dash\_
```
Alias for _::chain()


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 



custom
---
```php
custom($name): function
```
Gets a custom operation by name.


Parameter | Type | Description
--- | --- | :---
`$name` | `string` | Name of the custom operation


**Example:** 
```php
_::setCustom('double', function ($n) { return $n * 2; });
_::chain([1, 2, 3])->map(Dash\custom('double'))->value();  // === [2, 4, 6]
```

Number
===

isEven
---
```php
isEven($value): boolean
```
Checks whether a number is even.

If a double is provided, only its integer component is evaluated.


Parameter | Type | Description
--- | --- | :---
`$value` | `number` | 


**Example:** 
```php
isEven(3);  // === false
isEven(4);  // === true
isEven(4.7);  // === true
```
isOdd
---
```php
isOdd($value): boolean
```
Checks whether a number is odd.

If a double is provided, only its integer component is evaluated.


Parameter | Type | Description
--- | --- | :---
`$value` | `number` | 


**Example:** 
```php
isOdd(4);  // === false
isOdd(3);  // === true
isOdd(3.7);  // === true
```

Other
===

matches
---
```php
matches($properties)
```





matchesProperty
---
```php
matchesProperty($path, $value)
```





partial
---
```php
partial($function)
```





partialRight
---
```php
partialRight($function)
```





pick
---
```php
pick($input, $keys)
```





reduce
---
```php
reduce($iterable, $iteratee, $initial = [])
```





reject
---
```php
reject($iterable, $predicate)
```





result
---
```php
result($input, $path, $default = null)
```





reverse
---
```php
reverse($iterable)
```





set
---
```php
set(&$input, $path, $value)
```





size
---
```php
size($input, $encoding = 'utf8')
```





sort
---
```php
sort($iterable, $comparator = 'Dash\compare')
```





sum
---
```php
sum($iterable)
```





take
---
```php
take($iterable, $count = 1, $fromStart = 0)
```





takeRight
---
```php
takeRight($iterable, $count = 1, $fromEnd = 0)
```





takeWhile
---
```php
takeWhile($input, $predicate = 'Dash\identity')
```





tap
---
```php
tap($iterable, callable $interceptor)
```





thru
---
```php
thru($value, callable $interceptor)
```





toArray
---
```php
toArray($value)
```





where
---
```php
where($iterable, $properties)
```





without
---
```php
without($iterable, $excluded, $predicate = null)
```






Callable
===

negate
---
```php
negate($predicate): callable
```
Returns a new function that negates the return value of $predicate when invoked.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` | 



