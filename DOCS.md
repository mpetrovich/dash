Table of contents
===
### Iterable
- [all](#all)
- [any](#any)
- [each](#each)
- [filter](#filter)
- [get](#get)
- [map](#map)
- [mapValues](#mapvalues)
- [pluck](#pluck)
- [property](#property)

### Other
- [apply](#apply)
- [ary](#ary)
- [assertType](#asserttype)
- [at](#at)
- [average](#average)
- [call](#call)
- [chain](#chain)
- [compare](#compare)
- [contains](#contains)
- [custom](#custom)
- [deltas](#deltas)
- [difference](#difference)
- [display](#display)
- [dropWhile](#dropwhile)
- [equal](#equal)
- [every](#every)
- [find](#find)
- [findKey](#findkey)
- [findLast](#findlast)
- [findValue](#findvalue)
- [first](#first)
- [getDirect](#getdirect)
- [getDirectRef](#getdirectref)
- [groupBy](#groupby)
- [hasDirect](#hasdirect)
- [identical](#identical)
- [identity](#identity)
- [indexBy](#indexby)
- [intersection](#intersection)
- [is](#is)
- [isEmpty](#isempty)
- [isEven](#iseven)
- [isOdd](#isodd)
- [join](#join)
- [keyBy](#keyby)
- [keys](#keys)
- [last](#last)
- [matches](#matches)
- [matchesProperty](#matchesproperty)
- [max](#max)
- [median](#median)
- [min](#min)
- [negate](#negate)
- [partial](#partial)
- [partialRight](#partialright)
- [pick](#pick)
- [reduce](#reduce)
- [reject](#reject)
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
- [union](#union)
- [values](#values)
- [where](#where)
- [without](#without)


Iterable
===

all
---
```php
all($iterable, $predicate): bool
```
Checks whether $predicate returns truthy for every item in $iterable.


Name | Type | Description
--- | --- | ---
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
any($iterable, $predicate): bool
```
Checks whether $predicate returns truthy for any item in $iterable.


Name | Type | Description
--- | --- | ---
`$iterable` | `mixed` | 
`$predicate` | `callable` | A callable invoked with ($value, $key) that returns a boolean


**Example:** 
```php
all([1, 2, 3], function($n) { return $n > 5; });  // === false
all([1, 2, 3], 'Dash\isEven');  // === true
```
each
---
```php
each($iterable, $iteratee): array|object
```
Iterates over a collection and calls an iteratee function for each element.

Any changes to the value, key, or collection from within the iteratee
function are not persisted. If the original collection needs to be mutated,
use a native `foreach` loop instead.


Name | Type | Description
--- | --- | ---
`$iterable` | `array\|object` | 
`$iteratee` | `Callable` | Function called with (element, key, collection) for each element in $iterable. If $iteratee returns false, subsequent elements will be skipped and iteration will end. 


**Example:** 
```php
Dash\each(
	[1, 2, 3],
	function($n) { echo $n; }
);  // Prints "123"
```
filter
---
```php
filter($iterable, $predicate): array
```
Returns a subset of $iterable for which $predicate is truthy.
Keys and key order are preserved.


Name | Type | Description
--- | --- | ---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Callable invoked with ($value, $key) for each item in $iterable



get
---
```php
get($iterable, $path, $default = null): mixed
```
Gets the value at a path on a collection.


Name | Type | Description
--- | --- | ---
`$iterable` | `array\|object` | 
`$path` | `string` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period
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
map
---
```php
map($iterable, $iteratee = 'Dash\identity'): array
```
Creates a new indexed array of values by running each element in a
collection through an iteratee function.

Keys in the original collection are _not_ preserved; a freshly indexed array
is returned.


Name | Type | Description
--- | --- | ---
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


Name | Type | Description
--- | --- | ---
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
pluck
---
```php
pluck($iterable, $path, $default = null): array
```
Gets the value at a path for all elements in a collection.


Name | Type | Description
--- | --- | ---
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


Name | Type | Description
--- | --- | ---
`$path` | `string\|function` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period. If it is a function, the same function is returned.
`$default` | `mixed` | Default value to return if nothing exists at $path


**Example:** 
```php
$getter = Dash\property('a.b');
$iterable = [
	'a' => [
		'b' => 'value'
	]
];
$getter($iterable) == 'value';

```

**Example:** Array elements can be referenced by index
```php
$getter = Dash\property('people.1.name');
$iterable = [
	'people' => [
		['name' => 'Pete'],
		['name' => 'John'],
		['name' => 'Paul'],
	]
];
$getter($iterable) == 'John';

```

**Example:** Keys with the same name as the full path can be used
```php
$getter = Dash\property('a.b.c');
$iterable = ['a.b.c' => 'value'];
$getter($iterable) == 'value';
```

Other
===

apply
---
```php
apply($callable, $args): mixed
```
Invokes a callable with arguments passed as a list.

Name | Type | Description
--- | --- | ---
`$callable` | `callable` | 
`$args` | `array` | 


**Example:** 
```php
function saveUser($name, $email) { … }
apply('saveUser', ['John', 'jdoe@gmail.com']);
```
ary
---
```php
ary($callable, $ary): callable
```
Wraps $callable in a new function that only accepts up to $ary arguments and ignores the rest.


Name | Type | Description
--- | --- | ---
`$callable` | `callable` | 
`$ary` | `int` | Number of arguments to accept


**Example:** 
```php
$fileExists = ary('file_exists', 1);
$fileExists('foo.txt', 123, 456);  // file_exists() will only get called with 'foo.txt'
```
assertType
---
```php
assertType($input, $type): void
```
Throws an exception if $input's type is not $type.


Name | Type | Description
--- | --- | ---
`$input` | `mixed` | 
`$type` | `string\|array` | Single type or list of types


**Example:** 
```php
$input = [1, 2, 3];
assertType($input, 'object');  // will throw
```
at
---
```php
at($iterable, $index): mixed
```
Gets the value at the $index-th value of $iterable, ignoring key values.

Name | Type | Description
--- | --- | ---
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
average
---
```php
average($iterable): double
```
Gets the average of all values in $iterable.


Name | Type | Description
--- | --- | ---
`$iterable` | `iterable` | 



call
---
```php
call($callable): mixed
```


Name | Type | Description
--- | --- | ---
`$callable` | `callable` | 



chain
---
```php
chain($input = null)
```





compare
---
```php
compare($a, $b)
```





contains
---
```php
contains($iterable, $target, $predicate = 'Dash\equal')
```





custom
---
```php
custom($name): function
```
Gets a custom operation by name.


Name | Type | Description
--- | --- | ---
`$name` | `string` | Name of the custom operation


**Example:** 
```php
_::setCustom('double', function ($n) { return $n * 2; });
_::chain([1, 2, 3])->map(Dash\custom('double'))->value();  // === [2, 4, 6]
```
deltas
---
```php
deltas($iterable)
```





difference
---
```php
difference()
```





display
---
```php
display($value)
```





dropWhile
---
```php
dropWhile($input, $predicate = 'Dash\identity')
```





equal
---
```php
equal($a, $b)
```





every
---
```php
every($iterable, $predicate)
```





find
---
```php
find($iterable, $predicate)
```





findKey
---
```php
findKey($iterable, $predicate)
```





findLast
---
```php
findLast($iterable, $predicate)
```





findValue
---
```php
findValue($iterable, $predicate)
```





first
---
```php
first($iterable)
```





getDirect
---
```php
getDirect($input, $field, $default = null)
```





getDirectRef
---
```php

```





groupBy
---
```php
groupBy($input, $groupBy, $defaultGroup = null)
```





hasDirect
---
```php
hasDirect($subject, $field)
```





identical
---
```php
identical($a, $b)
```





identity
---
```php
identity($value)
```





indexBy
---
```php
indexBy($input, $indexBy = 'Dash\identity')
```





intersection
---
```php
intersection($iterables)
```





is
---
```php
is($value, $type)
```





isEmpty
---
```php
isEmpty($input)
```





isEven
---
```php
isEven($value)
```





isOdd
---
```php
isOdd($value)
```





join
---
```php
join($input, $glue)
```





keyBy
---
```php
keyBy($input, $keyBy = 'Dash\identity')
```





keys
---
```php
keys($iterable)
```





last
---
```php
last($iterable)
```





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





max
---
```php
max($iterable)
```





median
---
```php
median($iterable)
```





min
---
```php
min($iterable)
```





negate
---
```php
negate($function)
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





union
---
```php
union($iterables)
```





values
---
```php
values($iterable)
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





