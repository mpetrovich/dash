Operations
===
Is there an operation you'd like to see? [Open an issue](https://github.com/mpetrovich/Dash/issues/new?labels=enhancement) or vote on an existing one.

[Iterable](#iterable) | [Utility](#utility) | [Callable](#callable) | [Number](#number)
:--- | :--- | :--- | :---
[all](#all--every) / every | [assertType](#asserttype) | [apply](#apply) | [isEven](#iseven)
[any](#any--some) / some | [chain](#chain) | [ary](#ary) | [isOdd](#isodd)
[at](#at) | [compare](#compare) | [call](#call) | 
[average](#average--mean) / mean | [custom](#custom) | [currify](#currify) | 
[contains](#contains) | [debug](#debug) | [curry](#curry) | 
[deltas](#deltas) | [equal](#equal) | [curryN](#curryn) | 
[difference](#difference--diff) / diff | [identical](#identical) | [negate](#negate) | 
[dropWhile](#dropwhile) | [identity](#identity) | [partial](#partial) | 
[each](#each) | [isEmpty](#isempty) | [partialRight](#partialright) | 
[filter](#filter) | [isType](#istype) | [unary](#unary) | 
[find](#find) | [size](#size--count) / count |  | 
[findKey](#findkey) | [tap](#tap) |  | 
[findLast](#findlast) | [thru](#thru) |  | 
[findValue](#findvalue) |  |  | 
[first](#first--head) / head |  |  | 
[get](#get) |  |  | 
[getDirect](#getdirect) |  |  | 
[getDirectRef](#getdirectref) |  |  | 
[groupBy](#groupby) |  |  | 
[hasDirect](#hasdirect) |  |  | 
[intersection](#intersection--intersect) / intersect |  |  | 
[isIndexedArray](#isindexedarray) |  |  | 
[join](#join--implode) / implode |  |  | 
[keyBy](#keyby--indexby) / indexBy |  |  | 
[keys](#keys) |  |  | 
[last](#last) |  |  | 
[map](#map) |  |  | 
[mapValues](#mapvalues) |  |  | 
[matches](#matches) |  |  | 
[matchesProperty](#matchesproperty) |  |  | 
[max](#max) |  |  | 
[median](#median) |  |  | 
[min](#min) |  |  | 
[pick](#pick) |  |  | 
[pluck](#pluck) |  |  | 
[property](#property) |  |  | 
[reduce](#reduce) |  |  | 
[reject](#reject) |  |  | 
[result](#result) |  |  | 
[reverse](#reverse) |  |  | 
[rotate](#rotate) |  |  | 
[set](#set) |  |  | 
[sort](#sort) |  |  | 
[sum](#sum) |  |  | 
[take](#take) |  |  | 
[takeRight](#takeright) |  |  | 
[takeWhile](#takewhile) |  |  | 
[toArray](#toarray) |  |  | 
[union](#union) |  |  | 
[values](#values) |  |  | 
[where](#where) |  |  | 
[without](#without) |  |  | 

Iterable
===

all / every
---
```php
all($iterable, $predicate = 'Dash\identity'): boolean
```
Checks whether `$predicate` returns truthy for every item in `$iterable`.

Iteration will stop at the first falsey return value.

Note: Returns true if `$iterable` is empty, because everything is true of empty iterables.

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$predicate` | `callable` | (optional) Invoked with `($value, $key, $iterable)` for each element in `$iterable`
**Returns** | `boolean` | true if `$predicate` returns truthy for every item in `$iterable`

**Example:** 
```php
Dash\all([1, 3, 5], 'Dash\isOdd');
// === true

Dash\all([1, 3, 5], function ($n) { return $n != 3; });
// === false

Dash\all([], 'Dash\isOdd');
// === true

Dash\all((object) ['a' => 1, 'b' => 3, 'c' => 5], 'Dash\isOdd');
// === true

```

**Example:** With the default predicate
```php
Dash\all([true, true, true]);
// === true

Dash\all([true, false, true]);
// === false
```
any / some
---
```php
any($iterable, $predicate = 'Dash\identity'): boolean
```
Checks whether `$predicate` returns truthy for any item in `$iterable`.

Iteration will stop at the first truthy return value.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$predicate` | `callable` | (optional) Invoked with `($value, $key, $iterable)` for each element in `$iterable`
**Returns** | `boolean` | true if `$predicate` returns truthy for any item in `$iterable`

**Example:** 
```php
Dash\any([1, 2, 3], 'Dash\isEven');
// === true

Dash\any([1, 2, 3], function ($n) { return $n > 5; });
// === false

Dash\any([], 'Dash\isOdd');
// === false

Dash\any((object) ['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isEven');
// === true

```

**Example:** With the default predicate
```php
Dash\any([false, true, true]);
// === true

Dash\any([false, false, false]);
// === false
```
at
---
```php
at($iterable, $index, $default = null): mixed
```
Iterates over `$iterable` and returns the value of the `$index`th element, ignoring keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$index` | `numeric` | 0-based index
`$default` | `mixed` | (optional) Value to return if `$index` is out of bounds
**Returns** | `mixed` | Value of the `$index`th item of `$iterable, ignoring keys

**Example:** 
```php
Dash\at(['a', 'b', 'c'], 0);
// === 'a'

Dash\at([2 => 'a', 1 => 'b', 0 => 'c'], 0);
// === 'a'

Dash\at(['a' => 'first', 'b' => 'second', 'c' => 'third'], 2);
// === 'third'

```

**Example:** With a custom default value
```php
Dash\at(['a', 'b', 'c'], 5, 'none');
// === 'none'
```
average / mean
---
```php
average($iterable): double|null
```
Gets the average value of all elements in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `double\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\average([2, 3, 5, 8]);
// === 4.5
```
contains
---
```php
contains($iterable, $target, $comparator = 'Dash\equal'): boolean
```
Checks whether $iterable has any elements for which $comparator returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$target` | `mixed` | Value to compare $iterable elements against
`$comparator` | `callable` | Invoked with ($target, $value) for each value in $iterable
**Returns** | `boolean` | true if $comparator returns truthy for any elements in $iterable

**Example:** With loose equality comparison (the default)
```php
contains([1, '2', 3], 2);  // === true

```

**Example:** With strict equality comparison
```php
contains([1, '2', 3], 2, 'Dash\identical');  // === false
```
deltas
---
```php
deltas($iterable): array
```
Returns a new array whose values are the differences between subsequent elements of a iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | Iterable to compare against
`$iterables,...` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
`$predicate` | `callable\|mixed` | Value to compare against, or callable invoked with ($value, $key, $iterable)
**Returns** | `string\|integer\|null` | Value of the matching element, or null if not found

**Example:** With comparison value
```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
find($array, 3);  // === 3
find($array, 'Dash\isEven');  // === 2
```
first / head
---
```php
first($iterable): mixed|null
```
Gets the value of the first element in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\first(['a' => 'one', 'b' => 'two', 'c' => 'three']);
// === 'one'

Dash\first([]);
// === null
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | Iterable to compare against
`$iterables,...` | `iterable\|stdClass` | 
**Returns** | `array` | 

**Example:** 
```php
intersection(
	[1, 3, 5, 8],
	[1, 2, 3, 4]
);  // === [0 => 1, 1 => 3]
```
isIndexedArray
---
```php
isIndexedArray($value): boolean
```
Checks whether `$value` is an array with sequential integer keys starting at 0.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
**Returns** | `boolean` | True if `$value` is an indexed array, false otherwise

**Example:** 
```php
Dash\isIndexedArray(['a', 'b', 'c']);
// === true

Dash\isIndexedArray([1 => 'a', 'b', 'c']);
// === false

Dash\isIndexedArray(['a' => 1, 'b' => 2]);
// === false
```
join / implode
---
```php
join($iterable, $separator): string
```
Concatenates the string value of all elements in `$iterable`,
with each value separated by `$separator`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$separator` | `string` | 
**Returns** | `string` | 

**Example:** 
```php
Dash\join([123, 456, 789], '-');
// === '123-456-789'

Dash\join(['a' => 1, 'b' => 2, 'c' => 3], ', ');
// === '1, 2, 3'
```
keyBy / indexBy
---
```php
keyBy($iterable, $iteratee = 'Dash\identity'): array
```
Keys elements by the common values generated by an iteratee.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
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
Gets the keys of `$iterable` as an array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `array` | 

**Example:** 
```php
Dash\keys(['c' => 3, 'a' => 1, 'b' => 2]);
// === ['c', 'a', 'b']
```
last
---
```php
last($iterable): mixed|null
```
Gets the value of the last element in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\last(['a' => 'one', 'b' => 'two', 'c' => 'three']);
// === 'three'

Dash\last([]);
// === null
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
`$properties` | `iterable\|stdClass` | Key-value pairs that the returned function will match its input against
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
Gets the maximum value of all elements in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\max([3, 8, 2, 5]);
// === 8

Dash\max([]);
// === null
```
median
---
```php
median($iterable): mixed|null
```
Returns the median value of an iterable.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\median([3, 2, 1, 5, 4]);
// === 3

Dash\median([3, 2, 1, 4]);
// === 2.5
```
min
---
```php
min($iterable): mixed|null
```
Gets the minimum value of all elements in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\min([3, 8, 2, 5]);
// === 2

Dash\min([]);
// === null
```
pick
---
```php
pick($iterable, $keys): array|object
```
Returns a subset of $iterable with the specified keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
rotate
---
```php
rotate($iterable, $count = 1): array|object
```


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
`$count` | `numeric` | 
**Returns** | `array\|object` | 


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
`$iterable` | `iterable\|stdClass` | 
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
sum($iterable): numeric
```
Gets the sum of all element values in `$iterable`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
**Returns** | `numeric` | Zero if `$iterable` is empty

**Example:** 
```php
Dash\sum([2, 3, 5, 8]);
// === 18

Dash\sum([]);
// === 0
```
take
---
```php
take($iterable, $count = 1): array
```
Returns a new array of the first $count elements of $iterable. Non-integer keys are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterables,...` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
`$properties` | `iterable\|stdClass` | 
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
`$iterable` | `iterable\|stdClass` | 
`$exclude` | `array` | Values to exclude
**Returns** | `array` | Subset of $iterable

**Example:** 
```php
without(['a', 'b', 'c', 'd'], ['b', 'c']);
// === ['a', 'd']
```

Utility
===

assertType
---
```php
assertType($value, $type, $funcName = __FUNCTION__): void
```
Throws an `InvalidArgumentException` exception if `$value` is not of type `$type`.
If `$value` is an accepted type, this function is a no-op.

See Dash\isType() for the available types.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
`$type` | `string\|array` | Single type to check or a list of accepted types
`$funcName` | `string` | (optional) Name of the calling function where `assertType()` was called; this is used in the thrown exception message and aids debugging
**Returns** | `void` | 

**Example:** 
```php
$value = [1, 2, 3];
Dash\assertType($value, ['iterable', 'stdClass']);
// Does not throw an exception

$value = [1, 2, 3];
Dash\assertType($value, 'object');
// Throws an exception
```
chain
---
```php
chain($input = null): Dash\_
```
Creates a new chain. Alias for `_::chain()`.


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | (optional) Initial input value of the chain
**Returns** | `Dash\_` | A new chain

**Example:** 
```php
Dash\chain([1, 2, 3])
	->filter(function ($n) { return $n < 3; })
	->map(function ($n) { return $n * 2; })
	->value();
// === [2, 4]
```
compare
---
```php
compare($a, $b): integer
```
Returns a number less than, equal to, or greater than zero
if `$a` is less than, equal to, or greater than `$b`.

Uses loose equality for comparison. For comparison tables across data types,
see: http://php.net/manual/en/types.comparisons.php


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 
**Returns** | `integer` | 

**Example:** 
```php
Dash\compare(2, 3);
// < 0

Dash\compare(2, 1);
// > 0

Dash\compare(2, 2);
// === 0
```
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
debug
---
```php
debug($value /* , ...value */): mixed
```
Prints debugging information for one or more values.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | (variadic) One or more values to debug
**Returns** | `mixed` | The first argument

**Example:** 
```php
$returned = Dash\debug([1, 2, 3], 'hello', 3.14);
// $returned === [1, 2, 3]

// Prints:
array(3) {
  [0] =>
  int(1)
  [1] =>
  int(2)
  [2] =>
  int(3)
}
string(5) "hello"
double(3.14)
```
equal
---
```php
equal($a, $b): boolean
```
Checks whether `$a` and `$b` are loosely equal (same value, possibly different types).


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 
**Returns** | `boolean` | 

**Example:** 
```php
Dash\equal(3, '3');
// === true

Dash\equal(3, 3);
// === true

Dash\equal([1, 2, 3], [1, '2', 3]);
// === true

Dash\equal([1, 2, 3], [3, 2, 1]);
// === false
```
identical
---
```php
identical($a, $b): boolean
```
Checks whether `$a` and `$b` are strictly equal (same value and type).


Parameter | Type | Description
--- | --- | :---
`$a` | `mixed` | 
`$b` | `mixed` | 
**Returns** | `boolean` | 

**Example:** 
```php
Dash\identical(3, '3');
// === false

Dash\identical(3, 3);
// === true

Dash\identical([1, 2, 3], [1, '2', 3]);
// === false

Dash\identical([1, 2, 3], [1, 2, 3]);
// === true
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
**Returns** | `mixed` | `$value` unmodified

**Example:** 
```php
$a = new ArrayObject();
$b = Dash\identity($a);
// $b === $a
```
isEmpty
---
```php
isEmpty($value): boolean
```
Checks whether `$value` is empty.

A value is empty if it is an iterable of size zero or loosely equals false.

Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
**Returns** | `boolean` | True if `$value` is empty, false otherwise

**Example:** 
```php
Dash\isEmpty([]);
// === true

Dash\isEmpty((object) []);
// === true

Dash\isEmpty(new ArrayObject());
// === true

Dash\isEmpty('');
// === true

Dash\isEmpty(0);
// === true

Dash\isEmpty([0]);
// === false
```
isType
---
```php
isType($value, $type): boolean
```
Checks whether `$value` is of a particular data type.

A types can be:
- a native data type: `string`, `array`, `integer`, etc.
- a type corresponding to a native `is_*()` function:
`numeric` (for `is_numeric()`), `callable` (for `is_callable()`), etc.
- a class name: `stdClass`, `DateTime`, `Dash\_`, etc.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
`$type` | `string\|array` | Single type to check or a list of accepted types
**Returns** | `boolean` | 

**Example:** With a native data type
```php
Dash\isType([1, 2, 3], 'array');
// === true

```

**Example:** With a type corresponding to a native `is_*()` function
```php
Dash\isType(3.14, 'numeric');
// === true

```

**Example:** With a class name
```php
Dash\isType(new ArrayObject([1, 2, 3]), 'ArrayObject');
// === true

```

**Example:** With multiple types
```php
Dash\isType((object) [1, 2, 3], ['array', 'object']);
// === true
```
size / count
---
```php
size($input, $encoding = 'UTF-8'): integer|null
```
Returns the number of elements (for iterables) or characters (for strings) in $input.


Parameter | Type | Description
--- | --- | :---
`$input` | `iterable\|string` | 
`$encoding` | `string` | (optional) The character encoding of $input if it is a string; see mb_list_encodings() for the list of supported encodings
**Returns** | `integer\|null` | Null for non-iterable/string input

**Example:** 
```php
size([1, 2, 3]);  // === 3
size('Hello!');  // === 6
```
tap
---
```php
tap($value, callable $interceptor): mixed
```
Invokes `$interceptor` with `($value)` and returns `$value` unchanged.

Note: Any changes made to `$value` in `$interceptor` will not be returned.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
`$interceptor` | `callable` | Invoked with `($value)`
**Returns** | `mixed` | Original `$value`

**Example:** 
```php
$result = _::chain([1, 3, 4])
	->filter('Dash\isOdd')
	->tap(function ($value) {
		// $value === [1, 3]
		print_r($value);
	})
	->value();

// $result === [1, 3]
```
thru
---
```php
thru($value, callable $interceptor): mixed
```
Invokes `$interceptor` with `($value)` and returns its result.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
`$interceptor` | `callable` | Invoked with `($value)`
**Returns** | `mixed` | Return value of `$interceptor($value)`

**Example:** 
```php
$result = _::chain([1, 3, 4])
	->filter('Dash\isOdd')
	->thru(function ($value) {
		// $value === [1, 3]
		$value[] = $value[0];
		return $value;
	})
	->value();

// $result === [1, 3, 1]
```

Callable
===

apply
---
```php
apply(callable $callable, $args): mixed
```
Invokes `$callable` with a list of arguments.

Note: Contrary to other curried methods, the curried version of this method
accepts arguments in the same order as the original method.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$args` | `iterable\|stdClass` | Arguments to pass to `$callable`
**Returns** | `mixed` | Return value of `$callable`

**Example:** 
```php
$func = function ($time, $name) {
	return "Good $time, $name";
};

Dash\apply($func, ['morning', 'John']);
// === 'Good morning, John'

```

**Example:** Curried version accepts arguments in the same order
```php
$func = function ($time, $name) {
	return "Good $time, $name";
};

$apply = Dash\_apply($func);

$apply(['morning', 'John']);
// === 'Good morning, John'
```
ary
---
```php
ary(callable $callable, $arity): callable
```
Creates a new function that invokes `$callable` with up to `$arity` arguments and ignores the rest.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$arity` | `integer` | Maximum number of arguments to accept
**Returns** | `callable` | New function

**Example:** 
```php
$isNumeric = Dash\ary('is_numeric', 1);

Dash\filter([1, 2.0, '3', 'a'], $isNumeric);
// === [1, 2.0, '3']
```
call
---
```php
call(callable $callable /* , ...args */): mixed
```
Invokes `$callable` with an inline list of arguments.

Note: No curried function exists for this operation.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`...$args` | `mixed` | Inline arguments to pass to `$callable`
**Returns** | `mixed` | Return value of `$callable`

**Example:** 
```php
$func = function ($time, $name) {
	return "Good $time, $name";
};

Dash\call($func, 'morning', 'John');
// === 'Good morning, John'
```
currify
---
```php
currify($callable, array $args = [], $rotate = -1): mixed
```


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$args` | `array` | 
`$rotate` | `numeric` | 
**Returns** | `mixed` | 


curry
---
```php
curry(callable $callable /*, ...args */): mixed
```


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
**Returns** | `mixed` | 


curryN
---
```php
curryN($callable, $totalArgs /*, ...args */): mixed
```


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$totalArgs` | `numeric` | 
**Returns** | `mixed` | 


negate
---
```php
negate(callable $predicate): callable
```
Creates a new function that negates the return value of `$predicate`.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` | 
**Returns** | `callable` | New function

**Example:** 
```php
$isEven = function ($n) { return $n % 2 === 0; };
$isOdd = Dash\negate($isEven);

$isEven(3);  // === false
$isOdd(3);   // === true
```
partial
---
```php
partial($callable /* , ...args */): callable
```
Creates a function that invokes $callable with the given set of arguments prepended to any others passed in.

Use Dash\_ as a placeholder to replace with call-time arguments.


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
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};
$greetMark = Dash\partial($greet, Dash\_, 'Mark');
$greetJane = Dash\partial($greet, Dash\_, 'Jane');

$greetMark('Hello');  // === 'Hello, Mark!'
$greetJane('Howdy');  // === 'Howdy, Jane!'
```
partialRight
---
```php
partialRight($callable /* , ...args */): callable
```
Creates a function that invokes $callable with the given set of arguments appended to any others passed in.

Pass Dash\_ as a placeholder to replace with call-time arguments.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
**Returns** | `callable` | 

**Example:** 
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};
$greetMark = Dash\partialRight($greet, 'Mark');
$greetJane = Dash\partialRight($greet, 'Jane');

$this->assertSame('Hello, Mark!', $greetMark('Hello'));
$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));

```

**Example:** With a placeholder
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};
$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

$this->assertSame('Hello, Mark!', $sayHello('Mark'));
$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));
```
unary
---
```php
unary(callable $callable): callable
```
Creates a new function that invokes `$callable` with a single argument and ignores the rest.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
**Returns** | `callable` | New function

**Example:** 
```php
$isNumeric = Dash\unary('is_numeric');

Dash\filter([1, 2.0, '3', 'a'], $isNumeric);
// === [1, 2.0, '3']
```

Number
===

isEven
---
```php
isEven($value): boolean
```
Checks whether `$value` is an even number.

If a double is provided, only its truncated integer component is evaluated.


Parameter | Type | Description
--- | --- | :---
`$value` | `numeric` | 
**Returns** | `boolean` | True if `$value` is an even number, false otherwise

**Example:** 
```php
Dash\isEven(3);
// === false

Dash\isEven(4);
// === true

Dash\isEven(4.9);
// === true

Dash\isEven('a');
// === false
```
isOdd
---
```php
isOdd($value): boolean
```
Checks whether `$value` is an odd number.

If a double is provided, only its truncated integer component is evaluated.


Parameter | Type | Description
--- | --- | :---
`$value` | `numeric` | 
**Returns** | `boolean` | True if `$value` is an odd number, false otherwise

**Example:** 
```php
Dash\isOdd(3);
// === true

Dash\isOdd(4);
// === false

Dash\isOdd(5.9);
// === true

Dash\isOdd('a');
// === false
```
