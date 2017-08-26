Is there an operation you'd like to see? [Open an issue](https://github.com/mpetrovich/Dash/issues/new?labels=enhancement) and get others to vote on it!

Table of contents
===
### Iterable
- [all](#all--every) / every
- [any](#any)
- [at](#at)
- [average](#average)
- [contains](#contains)
- [deltas](#deltas)
- [difference](#difference--diff) / diff
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
- [intersection](#intersection--intersect) / intersect
- [isEmpty](#isempty)
- [isIndexedArray](#isindexedarray)
- [join](#join--implode) / implode
- [keyBy](#keyby--indexby) / indexBy
- [keys](#keys)
- [last](#last)
- [map](#map)
- [mapValues](#mapvalues)
- [matches](#matches)
- [matchesProperty](#matchesproperty)
- [max](#max)
- [median](#median)
- [min](#min)
- [pick](#pick)
- [pluck](#pluck)
- [property](#property)
- [reduce](#reduce)
- [reject](#reject)
- [result](#result)
- [reverse](#reverse)
- [set](#set)
- [sort](#sort)
- [sum](#sum)
- [take](#take)
- [takeRight](#takeright)
- [takeWhile](#takewhile)
- [toArray](#toarray)
- [union](#union)
- [values](#values)
- [where](#where)
- [without](#without)

### Callable
- [apply](#apply)
- [ary](#ary)
- [call](#call)
- [negate](#negate)
- [partial](#partial)
- [partialRight](#partialright)

### Utility
- [assertType](#asserttype)
- [compare](#compare)
- [display](#display)
- [equal](#equal)
- [identical](#identical)
- [identity](#identity)
- [isType](#istype)
- [size](#size--count) / count

### Dash
- [chain](#chain)
- [custom](#custom)
- [tap](#tap)
- [thru](#thru)

### Number
- [isEven](#iseven)
- [isOdd](#isodd)


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
**Returns** | `boolean` | true if $predicate returns truthy for every item in $iterable

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
**Returns** | `boolean` | 

**Example:** 
```php
all([1, 2, 3], function($n) { return $n > 5; });  // === false
all([1, 2, 3], 'Dash\isEven');  // === true
```
at
---
```php
at($iterable, $index, $default = null): mixed
```
Gets the value of the literal $index-th element of $iterable, ignoring key values.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$index` | `int` | 0-based index
`$default` | `mixed` | Value to return if $index is out of bounds
**Returns** | `mixed` | 

**Example:** 
```php
at(['a', 'b', 'c', 'd'], 2);  // === 'c'

```

**Example:** Keys are ignored; the literal i-th position is returned
```php
$input = (object) ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'];
at($input, 2);  // === 'three'
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
**Returns** | `double` | Average value

**Example:** 
```php
average([2, 3, 5, 8]);  // === 4.5
```
contains
---
```php
contains($iterable, $target, $comparator = 'Dash\equal'): boolean
```
Checks whether $iterable has any elements for which $comparator returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$target` | `mixed` | Value to compare $iterable elements against
`$comparator` | `callable` | Invoked with ($target, $value) for each value in $iterable
**Returns** | `boolean` | true if $comparator returns truthy for any elements in $iterable

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
**Returns** | `array` | 

**Example:** 
```php
deltas([3, 8, 9, 9, 5, 13]);  // === [0, 5, 1, 0, -4, 8]
```
difference / diff
---
```php
difference($iterable /* , ...iterables */): array
```
Returns a subset of items from the first iterable that are not present in any of the other iterables.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | Iterable to compare against
`$iterables,...` | `iterable` | 
**Returns** | `array` | 

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
**Returns** | `array` | 


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
**Returns** | `mixed` | $iterable

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
**Returns** | `array` | 

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
**Returns** | `array\|null` | [$key, $value] of the matching key/index and value, or null if not found

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
**Returns** | `string\|integer\|null` | Key of the matching element, or null if not found

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
**Returns** | `array\|null` | [$key, $value] of the matching key/index and value, or null if not found

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
**Returns** | `string\|integer\|null` | Value of the matching element, or null if not found

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
**Returns** | `mixed` | 

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
**Returns** | `mixed` | Value at $path on the collection

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
Gets the value or callable at the given key of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$key` | `string` | 
`$default` | `mixed` | Value to return if no value at $key exists
**Returns** | `mixed` | 

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
**Returns** | `mixed` | 

**Example:** 
```php
$obj = (object) ['key' => 'value'];
$ref = Dash\getDirectRef($obj, 'key');
$ref = 'changed';
// $obj->key === 'changed'
```
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
**Returns** | `array` | map of key => grouped elements

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
Checks whether an iterable has a value or callable at a given key.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object\|ArrayAccess` | 
`$key` | `string` | 
**Returns** | `boolean` | 

**Example:** 
```php
hasDirect(['a' => ['b' => 1, 'c' => 2], 'a');  // === true
hasDirect(['a' => ['b' => 1, 'c' => 2], 'b');  // === false

```

**Example:** 
```php
hasDirect((object) ['a' => 1, 'b' => 2], 'b');  // === true
```
intersection / intersect
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
**Returns** | `array` | 

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
**Returns** | `boolean` | 

**Example:** 
```php
isEmpty([]);                 // === true
isEmpty(new ArrayObject());  // === true
isEmpty('');                 // === true
isEmpty(0);                  // === true
isEmpty([0]);                // === false
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
**Returns** | `boolean` | 

**Example:** 
```php
isIndexedArray([1, 2, 3]);             // === true
isIndexedArray(['a' => 1, 'b' => 2]);  // === false
```
join / implode
---
```php
join($iterable, $separator): string
```
Concatenates all elements in $iterable to a string, each separated by $separator.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$separator` | `string` | 
**Returns** | `string` | 

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
**Returns** | `array` | map of key => grouped elements

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
**Returns** | `array` | 

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
**Returns** | `mixed` | 

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
**Returns** | `array` | 

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
**Returns** | `array` | 

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
matches
---
```php
matches($properties): callable
```
Creates a function with signature (iterable $iterable) that returns true if $iterable contains
all key-value pairs in $properties, using loose equality for value comparison.


Parameter | Type | Description
--- | --- | :---
`$properties` | `iterable` | Key-value pairs that the returned function will match its input against
**Returns** | `callable` | with signature (iterable $iterable)

**Example:** 
```php
$matcher = matches(['b' => 2, 'd' => 4]);
$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'e' => 5]);  // === false
```
matchesProperty
---
```php
matchesProperty($path, $value): callable
```
Creates a function with signature (iterable $iterable) that returns true
if it has a value at $path that is loosely equal to $value.


Parameter | Type | Description
--- | --- | :---
`$path` | `string` | Any valid path supported by Dash\get()
`$value` | `mixed` | Value to compare against
**Returns** | `callable` | with signature (iterable $iterable)

**Example:** 
```php
$matcher = matchesProperty('c', 3);
$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
$matcher(['a' => 1, 'b' => 2, 'd' => 4, 'e' => 5]);  // === false
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
**Returns** | `mixed\|null` | Null if $iterable is empty

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
**Returns** | `mixed\|null` | Null if $iterable is empty

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
**Returns** | `mixed\|null` | Null if $iterable is empty

**Example:** 
```php
min([3, 8, 2, 5]);  // === 2
```
pick
---
```php
pick($iterable, $keys): array|object
```
Returns a subset of $iterable with the specified keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$keys` | `string\|array` | 
**Returns** | `array\|object` | array if $iterable is array-like, object if $iterable is object-like

**Example:** 
```php
pick(['a' => 'one', 'b' => 'two', 'c' => 'three'], ['b', 'c']);
// === ['b' => 'two', 'c' => 'three']
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
**Returns** | `array` | 

**Example:** 
```php
pluck(
	[
		['a' => ['b' => 1]],
		['a' => 'missing'],
		['a' => ['b' => 3]],
		['a' => ['b' => 4]],
	],
	'a.b',
	'default'
);
// == [1, 'default', 3, 4];
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
**Returns** | `function` | Function that accepts a collection and returns the value at $path on the collection

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
reduce
---
```php
reduce($iterable, $iteratee, $initial = []): mixed
```
Iteratively reduces $iterable to a single value by way of $iteratee.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$iteratee` | `callable` | Invoked with ($result, $value, $key) for each ($key, $value) in $iterable and the current $result. $iteratee should return the updated $result
`$initial` | `mixed` | (optional) Initial value
**Returns** | `mixed` | 

**Example:** Computes the sum
```php
reduce([1, 2, 3, 4], function ($result, $value) {
	return $result + $value;
}, 0);
// === 10
```
reject
---
```php
reject($iterable, $predicate): array
```
Returns a subset of $iterable for which $predicate is falsey. Keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Callable invoked with ($value, $key, $iterable) for each item in $iterable
**Returns** | `array` | 

**Example:** 
```php
reject([1, 2, 3, 4], function ($n) { return $n > 2; });  // === [1, 2]
reject([1, 2, 3, 4], 'Dash\isEven');  // === [1, 3]

```

**Example:** With matchesProperty() shorthand
```php
reject([
	['name' => 'abc', 'active' => false],
	['name' => 'def', 'active' => true],
	['name' => 'ghi', 'active' => true],
], 'active');
// === [
	['name' => 'abc', 'active' => true],
]
```
result
---
```php
result($iterable, $path, $default = null): mixed
```
Like get(), but if the resolved value is callable, it will invoke the callable and return its result.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$path` | `callable\|string` | Callable used to retrieve the value or path of the property to retrieve; Paths can be nested by delimiting each sub-property or array index with a period, eg. 'a.b.0.c'
`$default` | `mixed` | Default value to return if nothing exists at $path 
**Returns** | `mixed` | Value at $path on the collection

**Example:** 
```php
$iterable = [
	'a' => [
		'b' => 'value'
	]
];
result($iterable, 'a.b');
// === 'value'

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
result($iterable, 'people.1.name');
// === 'John'

```

**Example:** Keys with the same name as the full path can be used
```php
$iterable = ['a.b.c' => 'value'];
result($iterable, 'a.b.c');
// === 'value'

```

**Example:** With a callable value
```php
$iterable = [
	'dates' => [
		'start' => new DateTime('2017-01-01'),
		'end' => new DateTime('2017-01-03'),
	]
]
result($iterable, 'dates.start.getTimestamp');
// === 1483246800
```
reverse
---
```php
reverse($iterable): array
```
Returns a new array with elements in reverse order. Non-integer keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
**Returns** | `array` | 

**Example:** 
```php
reverse(['a', 'b', 'c', 'd', 'e']);
// === ['e', 'd', 'c', 'b', 'a']

```

**Example:** 
```php
reverse(['a' => 'one', 'b' => 'two', 'c' => 'three']);
// === ['c' => 'three', 'b' => 'two', 'a' => 'one']
```
set
---
```php
set(&$iterable, $path, $value): array|object
```
Sets the value at a path on $iterable, which will be modified.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `array\|object` | 
`$path` | `string` | Path at which to set $value; can be a nested path (eg. 'a.b.0.c'), and non-existent intermediate array/objects will be created
`$value` | `mixed` | Value to set at $path
**Returns** | `array\|object` | the modified $iterable

**Example:** 
```php
$iterable = [
	'a' => [1, 2],
	'b' => [3, 4],
	'c' => [5, 6],
];
set($iterable, 'a', [7, 8, 9]);  // Setting a direct field
set($iterable, 'b.0', 10);  // Setting a nested field using an array index
// $iterable === [
	'a' => [7, 8, 9],
	'b' => [10, 4],
	'c' => [5, 6],
]

```

**Example:** Matching intermediate array wrappers are created when the deepest path is an array
```php
$iterable = [];
set($iterable, 'a.b.c', 'value');
// $iterable === [
	'a' => [
		'b' => [
			'c' => 'value'
		]
	]
]

```

**Example:** Matching intermediate object wrappers are created when the deepest path is an object
```php
$iterable = (object) [];
set($iterable, 'a.b.c', 'value');
// $iterable === (object) [
	'a' => (object) [
		'b' => (object) [
			'c' => 'value'
		]
	]
]
```
sort
---
```php
sort($iterable, $comparator = 'Dash\compare'): array
```
Returns a new array containing the sorted values of $iterable. Keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$comparator` | `callable` | 
**Returns** | `array` | 

**Example:** 
```php
sort([4, 1, 3, 2]);
// === [1, 2, 3, 4]
```
sum
---
```php
sum($iterable): double
```
Gets the sum of all values in $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
**Returns** | `double` | 

**Example:** 
```php
sum([1, 2, 3, 4]);  // === 10
```
take
---
```php
take($iterable, $count = 1): array
```
Returns a new array of the first $count elements of $iterable. Non-integer keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$count` | `integer` | If negative, all except the last $count elements will be returned
**Returns** | `array` | 

**Example:** 
```php
take(['a', 'b', 'c', 'd', 'e'], 3);
// === ['a', 'b', 'c']

```

**Example:** 
```php
take(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'], 2);
// === ['a' => 'one', 'b' => 'two']

```

**Example:** With a negative $count
```php
take(['a', 'b', 'c', 'd', 'e'], -2);
// === ['a', 'b', 'c']
```
takeRight
---
```php
takeRight($iterable, $count = 1): array
```
Returns a new array of the last $count elements of $iterable. Non-integer keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$count` | `integer` | If negative, all except the first $count elements will be returned
**Returns** | `array` | 

**Example:** 
```php
takeRight(['a', 'b', 'c', 'd', 'e'], 3);
// === ['c', 'd', 'e']

```

**Example:** 
```php
takeRight(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'], 2);
// === ['c' => 'three', 'd' => 'four']

```

**Example:** With a negative $count
```php
takeRight(['a', 'b', 'c', 'd', 'e'], -2);
// === ['c', 'd', 'e']
```
takeWhile
---
```php
takeWhile($iterable, $predicate = 'Dash\identity'): array|object
```
Returns a subset of $iterable taken from the beginning until $predicate returns falsey.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Invoked with ($value, $key)
**Returns** | `array\|object` | Array for array-like $iterable, object for object-like $iterable

**Example:** 
```php
takeWhile([2, 4, 6, 7, 8, 10], 'Dash\isEven');
// === [2, 4, 6]

```

**Example:** 
```php
takeWhile((object) ['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6], 'Dash\isEven');
// === (object) ['a' => 2, 'b' => 4]
```
toArray
---
```php
toArray($iterable): array
```
Returns an array representation of $iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
**Returns** | `array` | 

**Example:** 
```php
toArray((object) ['a' => 'one', 'b' => 'two']);
// === ['a' => 'one', 'b' => 'two']
```
union
---
```php
union(/* ...iterables */): array
```
Returns a new array containing the unique values, in order, of all arguments.

Iterable keys are preseved.


Parameter | Type | Description
--- | --- | :---
`$iterables,...` | `iterable` | 
**Returns** | `array` | 

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
**Returns** | `array` | 

**Example:** 
```php
values(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]);
// === [3, 8, 2, 5]
```
where
---
```php
where($iterable, $properties): array
```
Returns all elements of $iterable containing key-value pairs that loosely equal $properties.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$properties` | `iterable` | 
**Returns** | `array` | 

**Example:** 
```php
$input = [
	['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
	['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
	['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
	['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
	['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
];
where($input, ['gender' => 'f', 'age' => 30]);
// === [
	['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
	['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
]
```
without
---
```php
without($iterable, $exclude): array
```
Returns a new array of $iterable that excludes all values in $exclude, using loose equality for comparison.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$exclude` | `array` | Values to exclude
**Returns** | `array` | Subset of $iterable

**Example:** 
```php
without(['a', 'b', 'c', 'd'], ['b', 'c']);
// === ['a', 'd']
```

Callable
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
**Returns** | `mixed` | Return value of $callable

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
**Returns** | `callable` | New function that, when invoked, will call $callable with up to $ary arguments

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
**Returns** | `mixed` | Return value of $callable

**Example:** 
```php
$saveUser = function ($name, $email) { … };
call($saveUser, 'John', 'jdoe@gmail.com');
```
negate
---
```php
negate($predicate): callable
```
Returns a new function that negates the return value of $predicate when invoked.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` | 
**Returns** | `callable` | 


partial
---
```php
partial($callable /* , ...args */): callable
```
Creates a function that invokes $callable with the given set of arguments prepended to any others passed in.

Pass Dash\PLACEHOLDER as a placeholder to replace with call-time arguments.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
**Returns** | `callable` | 

**Example:** 
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};
$sayHello = Dash\partial($greet, 'Hello');
$sayHowdy = Dash\partial($greet, 'Howdy');

$sayHello('Mark');  // === 'Hello, Mark!'
$sayHowdy('Jane');  // === 'Howdy, Jane!'

```

**Example:** With a placeholder
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name!";
};
$greetMr = Dash\partial($greet, Dash\PLACEHOLDER, 'Mr.');
$greetMr('Hello', 'Mark');  // === 'Hello, Mr. Mark!'
```
partialRight
---
```php
partialRight($callable /* , ...args */): callable
```
Creates a function that invokes $callable with the given set of arguments appended to any others passed in.

Pass Dash\PLACEHOLDER as a placeholder to replace with call-time arguments.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
**Returns** | `callable` | 

**Example:** 
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};
$greetMark = Dash\partial($greet, 'Mark');
$greetJane = Dash\partial($greet, 'Jane');

$greetMark('Hello');  // === 'Hello, Mark!'
$greetJane('Howdy');  // === 'Howdy, Jane!'

```

**Example:** With a placeholder
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name!";
};
$greetMr = Dash\partialRight($greet, 'Mr.', Dash\PLACEHOLDER);
$greetMr('Hello', 'Mark');  // === 'Hello, Mr. Mark!'
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
**Returns** | `void` | 

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
**Returns** | `int` | 

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
**Returns** | `mixed` | $value

**Example:** 
```php
display([1, 2, 3]);
// echoes:
Array
(
	[0] => 1
	[1] => 2
	[2] => 3
)
```
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
**Returns** | `boolean` | 

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
**Returns** | `boolean` | 

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
**Returns** | `mixed` | $value itself

**Example:** 
```php
$a = new ArrayObject();
identity($a);  // === $a
```
isType
---
```php
isType($value, $type): boolean
```
Checks whether a value is of a particular data type.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | Value to check
`$type` | `string\|array` | Single type to check or a list of possible types; types can be: a native data type (eg. 'string', 'array'), a type corresponding to a native is_<type>() function (eg. 'numeric'), a class instance (eg. 'DateTime')
**Returns** | `boolean` | 

**Example:** With a native data type
```php
isType([1, 2, 3], 'array');  // === true

```

**Example:** With a type corresponding to a native is_<type>() method
```php
isType(3.14, 'numeric');  // === true

```

**Example:** 'iterable', in contrast with is_iterable(), returns true for stdClass objects
```php
$obj = (objec) [1, 2, 3];
is_iterable($obj);     // === false
isType($obj, 'iterable');  // === true

```

**Example:** With a class instance
```php
isType(new ArrayObject([1, 2, 3]), 'ArrayObject');  // === true
```
size / count
---
```php
size($input, $encoding = 'UTF-8'): integer
```
Returns the number of elements (for iterables) or characters (for strings) in $input.


Parameter | Type | Description
--- | --- | :---
`$input` | `iterable\|string` | 
`$encoding` | `string` | (optional) The character encoding of $input if it is a string; see mb_list_encodings() for the list of supported encodings
**Returns** | `integer` | 

**Example:** 
```php
size([1, 2, 3]);  // === 3
size('Hello!');  // === 6
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
**Returns** | `Dash\_` | New chain instance


custom
---
```php
custom($name): function
```
Gets a custom operation by name.


Parameter | Type | Description
--- | --- | :---
`$name` | `string` | Name of the custom operation
**Returns** | `function` | The custom operation

**Example:** 
```php
_::setCustom('double', function ($n) { return $n * 2; });
_::chain([1, 2, 3])->map(Dash\custom('double'))->value();  // === [2, 4, 6]
```
tap
---
```php
tap($iterable, callable $interceptor): iterable
```
Invokes $interceptor with ($iterable) and returns $iterable.

Note: Any changes to $iterable in $interceptor will not be persisted.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$interceptor` | `callable` | Invoked with ($iterable)
**Returns** | `iterable` | $iterable


thru
---
```php
thru($iterable, callable $interceptor): iterable
```
Invokes interceptor with ($iterable) and returns its result.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable` | 
`$interceptor` | `callable` | Invoked with ($iterable)
**Returns** | `iterable` | Result of $interceptor($iterable)



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
**Returns** | `boolean` | 

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
**Returns** | `boolean` | 

**Example:** 
```php
isOdd(4);  // === false
isOdd(3);  // === true
isOdd(3.7);  // === true
```
