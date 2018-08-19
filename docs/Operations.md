Operations
===
Is there an operation you'd like to see? [Open an issue](https://github.com/nextbigsoundinc/dash/issues/new?labels=enhancement) or vote on an existing one.

Iterable
---
Operation | Signature
:--- | :---
[all](#all--every) / every | `all($iterable, $predicate = 'Dash\identity'): boolean`
[any](#any--some) / some | `any($iterable, $predicate = 'Dash\identity'): boolean`
[at](#at) | `at($iterable, $index, $default = null): mixed`
[average](#average--mean) / mean | `average($iterable): double\|null`
[contains](#contains--includes) / includes | `contains($iterable, $target, $comparator = 'Dash\equal'): boolean`
[deltas](#deltas) | `deltas($iterable): array`
[difference](#difference) | `difference($iterable /*, ...iterables */): array`
[each](#each) | `each($iterable, $iteratee): mixed`
[filter](#filter) | `filter($iterable, $predicate = 'Dash\identity'): array\|iterable`
[find](#find) | `find($iterable, $predicate = 'Dash\identity'): array\|null`
[findKey](#findkey) | `findKey($iterable, $predicate = 'Dash\identity'): string\|null`
[findLast](#findlast) | `findLast($iterable, $predicate = 'Dash\identity'): array\|null`
[findLastKey](#findlastkey) | `findLastKey($iterable, $predicate = 'Dash\identity'): string\|null`
[findLastValue](#findlastvalue) | `findLastValue($iterable, $predicate = 'Dash\identity'): mixed\|null`
[findValue](#findvalue) | `findValue($iterable, $predicate = 'Dash\identity'): mixed\|null`
[first](#first--head) / head | `first($iterable): mixed\|null`
[groupBy](#groupby) | `groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array`
[intersection](#intersection) | `intersection($iterable /*, ...iterables */): array`
[isIndexedArray](#isindexedarray) | `isIndexedArray($value): boolean`
[join](#join--implode) / implode | `join($iterable, $separator): string`
[keyBy](#keyby--indexby) / indexBy | `keyBy($iterable, $iteratee = 'Dash\identity'): array`
[keys](#keys) | `keys($iterable): array`
[last](#last) | `last($iterable): mixed\|null`
[map](#map) | `map($iterable, $iteratee = 'Dash\identity'): array`
[mapValues](#mapvalues) | `mapValues($iterable, $iteratee = 'Dash\identity'): array`
[matchesProperty](#matchesproperty) | `matchesProperty($path, $value = true, $comparator = 'Dash\equal'): function`
[max](#max) | `max($iterable): mixed\|null`
[median](#median) | `median($iterable): mixed\|null`
[min](#min) | `min($iterable): mixed\|null`
[omit](#omit) | `omit($iterable, $keys): array`
[pick](#pick) | `pick($iterable, $keys): array`
[pluck](#pluck) | `pluck($iterable, $path, $default = null): array`
[property](#property) | `property($path, $default = null): function`
[reduce](#reduce) | `reduce($iterable, $iteratee, $initial = []): mixed`
[reject](#reject) | `reject($iterable, $predicate = 'Dash\identity'): array`
[reverse](#reverse) | `reverse($iterable, $preserveIntegerKeys = false): array`
[rotate](#rotate) | `rotate($iterable, $count = 1): array`
[sort](#sort) | `sort($iterable, $comparator = 'Dash\compare'): array`
[sum](#sum) | `sum($iterable): numeric`
[take](#take) | `take($iterable, $count = 1): array\|iterable`
[takeRight](#takeright) | `takeRight($iterable, $count = 1): array`
[toArray](#toarray) | `toArray($value): array`
[toObject](#toobject) | `toObject($value): object`
[union](#union) | `union($iterable /*, ...iterables */): array`
[values](#values) | `values($iterable): array`

Utility
---
Operation | Signature
:--- | :---
[assertType](#asserttype) | `assertType($value, $type, $funcName = __FUNCTION__): void`
[chain](#chain) | `chain($input = null): Dash\_`
[compare](#compare) | `compare($a, $b): integer`
[custom](#custom) | `custom($name): function`
[debug](#debug) | `debug($value /*, ...value */): mixed`
[equal](#equal) | `equal($a, $b): boolean`
[get](#get) | `get($input, $path, $default = null): mixed`
[getDirect](#getdirect) | `getDirect($input, $key, $default = null): mixed`
[getDirectRef](#getdirectref) | `getDirectRef(&$input, $key): mixed`
[hasDirect](#hasdirect) | `hasDirect($input, $key): boolean`
[identical](#identical) | `identical($a, $b): boolean`
[identity](#identity) | `identity($value): mixed`
[isEmpty](#isempty) | `isEmpty($value): boolean`
[isType](#istype) | `isType($value, $type): boolean`
[result](#result) | `result($input, $path, $default = null): mixed`
[set](#set) | `set(&$input, $path, $value): mixed`
[size](#size--count) / count | `size($value, $encoding = 'UTF-8'): integer`
[tap](#tap) | `tap($value, callable $interceptor): mixed`
[thru](#thru) | `thru($value, callable $interceptor): mixed`

Callable
---
Operation | Signature
:--- | :---
[apply](#apply) | `apply(callable $callable, $args): mixed`
[ary](#ary) | `ary(callable $callable, $arity): callable`
[call](#call) | `call(callable $callable /*, ...args */): mixed`
[currify](#currify) | `currify(callable $callable, array $args = [], $rotate = 1): function\|mixed`
[currifyN](#currifyn) | `currifyN(callable $callable, $totalArgs, array $args = [], $rotate = 1): function\|mixed`
[curry](#curry) | `curry(callable $callable /*, ...args */): function\|mixed`
[curryN](#curryn) | `curryN(callable $callable, $numRequiredArgs /*, ...args */): function\|mixed`
[curryRight](#curryright) | `curryRight(callable $callable /*, ...args */): function\|mixed`
[curryRightN](#curryrightn) | `curryRightN(callable $callable, $numRequiredArgs /*, ...args */): function\|mixed`
[negate](#negate) | `negate(callable $predicate): callable`
[partial](#partial) | `partial($callable /*, ...args */): callable`
[partialRight](#partialright) | `partialRight($callable /*, ...args */): callable`
[unary](#unary) | `unary(callable $callable): callable`

Number
---
Operation | Signature
:--- | :---
[isEven](#iseven) | `isEven($value): boolean`
[isOdd](#isodd) | `isOdd($value): boolean`


Iterable
===

all / every
---
[Operations](#operations) › [Iterable](#iterable)

```php
all($iterable, $predicate = 'Dash\identity'): boolean

# Curried: (all parameters required)
Curry\all($predicate, $iterable)
```
Checks whether `$predicate` returns truthy for every item in `$iterable`.

Iteration will stop at the first falsey return value.

Note: Returns true if `$iterable` is empty, because everything is true of empty iterables.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
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

[↑ Top](#operations)

any / some
---
[Operations](#operations) › [Iterable](#iterable)

```php
any($iterable, $predicate = 'Dash\identity'): boolean

# Curried: (all parameters required)
Curry\any($predicate, $iterable)
```
Checks whether `$predicate` returns truthy for any item in `$iterable`.

Iteration will stop at the first truthy return value.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable` | (optional) Invoked with `($value, $key, $iterable)` for each element in `$iterable`
**Returns** | `boolean` | true if `$predicate` returns truthy for any element in `$iterable`

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

[↑ Top](#operations)

at
---
[Operations](#operations) › [Iterable](#iterable)

```php
at($iterable, $index, $default = null): mixed

# Curried: (all parameters required)
Curry\at($index, $default, $iterable)
```
Iterates over `$iterable` and returns the value of the `$index`th element, ignoring keys.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$index` | `integer` | 0-based index
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

[↑ Top](#operations)

average / mean
---
[Operations](#operations) › [Iterable](#iterable)

```php
average($iterable): double|null

# Curried: (all parameters required)
Curry\average($iterable)
```
Gets the average value of all elements in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `double\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\average([2, 3, 5, 8]);
// === 4.5
```

[↑ Top](#operations)

contains / includes
---
[Operations](#operations) › [Iterable](#iterable)

```php
contains($iterable, $target, $comparator = 'Dash\equal'): boolean

# Curried: (all parameters required)
Curry\contains($target, $comparator, $iterable)
```
Checks whether `$iterable` has any elements for which `$comparator` returns truthy.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$target` | `mixed` | Value to compare
`$comparator` | `callable` | Invoked with `($target, $value)` for each element in `$iterable`
**Returns** | `boolean` | true if `$comparator` returns truthy for any element in `$iterable`

**Example:** With loose equality comparison (the default)
```php
Dash\contains([1, '2', 3], 2);
// === true

```

**Example:** With strict equality comparison
```php
Dash\contains([1, '2', 3], 2, 'Dash\identical');
// === false
```

[↑ Top](#operations)

deltas
---
[Operations](#operations) › [Iterable](#iterable)

```php
deltas($iterable): array

# Curried: (all parameters required)
Curry\deltas($iterable)
```
Returns a new array whose values are the differences between successive values of `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `array` | 

**Example:** 
```php
Dash\deltas([3, 8, 9, 9, 5, 13]);
// === [0, 5, 1, 0, -4, 8]
```

[↑ Top](#operations)

difference
---
[Operations](#operations) › [Iterable](#iterable)

```php
difference($iterable /*, ...iterables */): array
```
Returns the set of elements from `$iterable` whose values are not present in any of the other iterables,
where values are compared using loose equality.

The order, keys, and values of elements in the returned array are determined by `$iterable`.

Related: `intersection()`, `union()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | (variadic) Iterable against which all other passed iterables are compared
**Returns** | `array` | 

**Example:** With indexed arrays
```php
Dash\difference(
	[1, 2, 3, 4, 5],
	['2', 4],
	[3.0, 4]
);
// === [1, 5]

```

**Example:** With associative arrays
```php
Dash\difference(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
	['a' => '2', 'b' => 4],
	['a' => 3.0, 'b' => 4]
);
// === ['a' => 1, 'e' => 5]
```

[↑ Top](#operations)

each
---
[Operations](#operations) › [Iterable](#iterable)

```php
each($iterable, $iteratee): mixed

# Curried: (all parameters required)
Curry\each($iteratee, $iterable)
```
Iterates over elements of `$iterable` and invokes `$iteratee` for each element.

`$iteratee` is invoked with `($value, $key, $iterable)` for each element.
Iteratees can exit iteration early by returning `false`.
Any changes to `$value`, `$key`, or `$iterable` from within the iteratee will not persisted.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable` | 
**Returns** | `mixed` | $iterable The original `$iterable`

**Example:** 
```php
Dash\each(['a', 'b', 'c'], function ($value, $index, $array) {
	echo "[$index]: $value\n";
});
// Prints:
// [0]: 'a'
// [1]: 'b'
// [2]: 'c'

```

**Example:** Early exit
```php
Dash\each(['a', 'b', 'c'], function ($value, $index, $array) {
	echo "[$index]: $value\n";
	if ($value === 'b') {
		return false;
	}
});
// Prints:
// [0]: 'a'
// [1]: 'b'
```

[↑ Top](#operations)

filter
---
[Operations](#operations) › [Iterable](#iterable)

```php
filter($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\filter($predicate, $iterable)
```
Gets a list of elements in `$iterable` for which `$predicate` returns truthy.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)

Related: `reject()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will get elements with truthy values at `$field`; if an array of form `[$field, $value]`, will get elements whose `$field` loosely equals `$value`
**Returns** | `array\|iterable` | List of elements in `$iterable` that satisfy `$predicate`

**Example:** 
```php
Dash\filter([1, 2, 3, 4], 'Dash\isEven');
// === [2, 4]

Dash\filter(
	[3 => 'c', 1 => 'a', 2 => 'b'],
	function ($value, $key) { return $key > 1; }
);
// === [3 => 'c', 2 => 'b']

```

**Example:** The default predicate checks truthiness
```php
Dash\filter([1, 2, null, 3, false, true]);
// === [1, 2, 3, true]

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
];

Dash\filter($data, 'active');
// === [
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true]
]

Dash\filter($data, ['active', false]);
// === [
	['name' => 'John', 'active' => false],
]
```

[↑ Top](#operations)

find
---
[Operations](#operations) › [Iterable](#iterable)

```php
find($iterable, $predicate = 'Dash\identity'): array|null

# Curried: (all parameters required)
Curry\find($predicate, $iterable)
```
Gets the key and value of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.

Related: `findKey()`, `findValue()`, `findLast()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the first element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the first element whose `$field` loosely equals `$value`
**Returns** | `array\|null` | `[$key, $value]` of the matching key and value, or null if not found

**Example:** 
```php
Dash\find(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === ['b', 2]

Dash\find(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === ['c', 3]

```

**Example:** The default predicate checks truthiness
```php
Dash\find([0, null, false, 'a', true]);
// === [3, 'a']

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\find($data, 'active');
// === [1, ['name' => 'Mary', 'active' => true]]

Dash\find($data, ['active', false]);
// === [0, ['name' => 'John', 'active' => false]]
```

[↑ Top](#operations)

findKey
---
[Operations](#operations) › [Iterable](#iterable)

```php
findKey($iterable, $predicate = 'Dash\identity'): string|null

# Curried: (all parameters required)
Curry\findKey($predicate, $iterable)
```
Gets the key of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.

Related: `find()`, `findValue()`, `findLastKey()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the first element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the first element whose `$field` loosely equals `$value`
**Returns** | `string\|null` | The key of the first matching element, or null if not found

**Example:** 
```php
Dash\findKey(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === 'b'

Dash\findKey(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === 'c'

```

**Example:** The default predicate checks truthiness
```php
Dash\findKey([0, null, false, 'a', true]);
// === 3

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\findKey($data, 'active');
// === 1

Dash\findKey($data, ['active', false]);
// === 0
```

[↑ Top](#operations)

findLast
---
[Operations](#operations) › [Iterable](#iterable)

```php
findLast($iterable, $predicate = 'Dash\identity'): array|null

# Curried: (all parameters required)
Curry\findLast($predicate, $iterable)
```
Gets the key and value of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.

Related: `findLastKey()`, `findLastValue()`, `find()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the last element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the last element whose `$field` loosely equals `$value`
**Returns** | `array\|null` | `[$key, $value]` of the last matching element, or null if not found

**Example:** 
```php
Dash\findLast(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === ['d', 4]

Dash\findLast(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === ['d', 4]

```

**Example:** The default predicate checks truthiness
```php
Dash\findLast([0, null, false, 'a', true]);
// === [4, true]

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\findLast($data, 'active');
// === [2, ['name' => 'Pete', 'active' => true]]

Dash\findLast($data, ['active', false]);
// === [3, ['name' => 'Jane', 'active' => false]]
```

[↑ Top](#operations)

findLastKey
---
[Operations](#operations) › [Iterable](#iterable)

```php
findLastKey($iterable, $predicate = 'Dash\identity'): string|null

# Curried: (all parameters required)
Curry\findLastKey($predicate, $iterable)
```
Gets the key of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.

Related: `findLast()`, `findLastValue()`, `findKey()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the last element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the last element whose `$field` loosely equals `$value`
**Returns** | `string\|null` | The key of the last matching element, or null if not found

**Example:** 
```php
Dash\findLastKey(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === 'd'

Dash\findLastKey(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === 'd'

```

**Example:** The default predicate checks truthiness
```php
Dash\findLastKey([0, null, false, 'a', true]);
// === 4

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\findLastKey($data, 'active');
// === 2

Dash\findLastKey($data, ['active', false]);
// === 3
```

[↑ Top](#operations)

findLastValue
---
[Operations](#operations) › [Iterable](#iterable)

```php
findLastValue($iterable, $predicate = 'Dash\identity'): mixed|null

# Curried: (all parameters required)
Curry\findLastValue($predicate, $iterable)
```
Gets the value of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.

Related: `findLast()`, `findLastKey()`, `findValue()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the last element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the last element whose `$field` loosely equals `$value`
**Returns** | `mixed\|null` | The value of the last matching element, or null if not found

**Example:** 
```php
Dash\findLastValue(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === 4

Dash\findLastValue(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === 4

```

**Example:** The default predicate checks truthiness
```php
Dash\findLastValue([0, null, false, 'a', true]);
// === true

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\findLastValue($data, 'active');
// === ['name' => 'Pete', 'active' => true]

Dash\findLastValue($data, ['active', false]);
// === ['name' => 'Jane', 'active' => false]
```

[↑ Top](#operations)

findValue
---
[Operations](#operations) › [Iterable](#iterable)

```php
findValue($iterable, $predicate = 'Dash\identity'): mixed|null

# Curried: (all parameters required)
Curry\findValue($predicate, $iterable)
```
Gets the value of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.

Related: `find()`, `findKey()`, `findLastValue()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` until a truthy value is returned; if a string, will get the first element with a truthy value at `$field`; if an array of form `[$field, $value]`, will get the first element whose `$field` loosely equals `$value`
**Returns** | `mixed\|null` | The value of the first matching element, or null if not found

**Example:** 
```php
Dash\findValue(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === 2

Dash\findValue(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
	function ($value, $key) { return $value > 1 && $key !== 'b'; }
);
// === 3

```

**Example:** The default predicate checks truthiness
```php
Dash\findValue([0, null, false, 'a', true]);
// === 'a'

```

**Example:** With a field and value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
	['name' => 'Jane', 'active' => false],
];

Dash\findValue($data, 'active');
// === ['name' => 'Mary', 'active' => true]

Dash\findValue($data, ['active', false]);
// === ['name' => 'John', 'active' => false]
```

[↑ Top](#operations)

first / head
---
[Operations](#operations) › [Iterable](#iterable)

```php
first($iterable): mixed|null

# Curried: (all parameters required)
Curry\first($iterable)
```
Gets the value of the first element in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\first(['a' => 'one', 'b' => 'two', 'c' => 'three']);
// === 'one'

Dash\first([]);
// === null
```

[↑ Top](#operations)

groupBy
---
[Operations](#operations) › [Iterable](#iterable)

```php
groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array

# Curried: (all parameters required)
Curry\groupBy($iteratee, $defaultGroup, iterable)
```
Groups the element values of `$iterable` by the common return values of `$iteratee`.

Related: `keyBy()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable\|string` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable` if a string, will use `Dash\property($iteratee)` as the iteratee
`$defaultGroup` | `string` | (optional) The key for the set of elements for which `$iteratee` returns `null`
**Returns** | `array` | A new associative array of `[key => [value, ...]]`

**Example:** 
```php
Dash\groupBy(['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isOdd');
// === [true => [1, 3], false => [2]]

Dash\groupBy([2.1, 2.5, 3.5, 3.9, 4.1], Dash\unary('floor'));
// === [2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4.1]]

```

**Example:** With a path `$iteratee`
```php
$data = [
	['first' => 'John', 'last' => 'Doe'],
	['first' => 'Alice', 'last' => 'Hart'],
	['first' => 'Anonymous'],
	['first' => 'Jane', 'last' => 'Doe'],
	['first' => 'Peter', 'last' => 'Gibbons'],
	['first' => 'Fred', 'last' => 'Hart'],
];

Dash\groupBy($data, 'last');
// === [
	'Doe' => [
		['first' => 'John', 'last' => 'Doe'],
		['first' => 'Jane', 'last' => 'Doe'],
	],
	'Hart' => [
		['first' => 'Alice', 'last' => 'Hart'],
		['first' => 'Fred', 'last' => 'Hart'],
	],
	'Gibbons' => [
		['first' => 'Peter', 'last' => 'Gibbons'],
	],
	null => [
		['first' => 'Anonymous'],
	],
]

Dash\groupBy($data, 'last', 'Unknown');
// === [
	'Doe' => [
		['first' => 'John', 'last' => 'Doe'],
		['first' => 'Jane', 'last' => 'Doe'],
	],
	'Hart' => [
		['first' => 'Alice', 'last' => 'Hart'],
		['first' => 'Fred', 'last' => 'Hart'],
	],
	'Gibbons' => [
		['first' => 'Peter', 'last' => 'Gibbons'],
	],
	'Unknown' => [
		['first' => 'Anonymous'],
	],
]
```

[↑ Top](#operations)

intersection
---
[Operations](#operations) › [Iterable](#iterable)

```php
intersection($iterable /*, ...iterables */): array
```
Returns the set of elements from `$iterable` whose values are present in each of the other iterables,
where values are compared using loose equality.

The order, keys, and values of elements in the returned array are determined by `$iterable`.

Related: `difference()`, `union()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | (variadic) Iterable against which all other passed iterables are compared
**Returns** | `array` | 

**Example:** With indexed arrays
```php
Dash\intersection(
	[1, 2, 3, 4, 5],
	['2', '4'],
	[4.0, 2.0]
);
// === [2, 4]

```

**Example:** With associative arrays
```php
Dash\intersection(
	['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
	['a' => 2, 'b' => 4],
	['a' => 4, 'b' => 2]
);
// === ['b' => 2, 'd' => 4]
```

[↑ Top](#operations)

isIndexedArray
---
[Operations](#operations) › [Iterable](#iterable)

```php
isIndexedArray($value): boolean

# Curried: (all parameters required)
Curry\isIndexedArray($value)
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

[↑ Top](#operations)

join / implode
---
[Operations](#operations) › [Iterable](#iterable)

```php
join($iterable, $separator): string

# Curried: (all parameters required)
Curry\join($separator, $iterable)
```
Concatenates the string value of all elements in `$iterable`,
with each value separated by `$separator`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$separator` | `string` | 
**Returns** | `string` | 

**Example:** 
```php
Dash\join([123, 456, 789], '-');
// === '123-456-789'

Dash\join(['a' => 1, 'b' => 2, 'c' => 3], ', ');
// === '1, 2, 3'
```

[↑ Top](#operations)

keyBy / indexBy
---
[Operations](#operations) › [Iterable](#iterable)

```php
keyBy($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\keyBy($iteratee, $iterable)
```
Gets the element values of `$iterable` as an associative array indexed by `$iteratee`.

A later value will overwrite an earlier value that has the same key.

Related: `groupBy()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable\|string` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will use `Dash\property($iteratee)` as the iteratee
**Returns** | `array` | A new associative array

**Example:** 
```php
$data = [
	['first' => 'John', 'last' => 'Doe'],
	['first' => 'Alice', 'last' => 'Hart'],
	['first' => 'Jane', 'last' => 'Smith'],
	['first' => 'Peter', 'last' => 'Gibbons'],
	['first' => 'Fred', 'last' => 'Durst'],
];

Dash\keyBy($data, function ($value) {
	return $value['first'] . ' ' . $value['last'];
});
// === [
	'John Doe' => ['first' => 'John', 'last' => 'Doe'],
	'Alice Hart' => ['first' => 'Alice', 'last' => 'Hart'],
	'Jane Smith' => ['first' => 'Jane', 'last' => 'Smith'],
	'Peter Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
	'Fred Durst' => ['first' => 'Fred', 'last' => 'Durst'],
]

```

**Example:** With a path `$iteratee`
```php
$data = [
	['first' => 'John', 'last' => 'Doe'],
	['first' => 'Alice', 'last' => 'Hart'],
	['first' => 'Jane', 'last' => 'Smith'],
	['first' => 'Peter', 'last' => 'Gibbons'],
	['first' => 'Fred', 'last' => 'Durst'],
];

Dash\keyBy($data, 'last');
// === [
	'Doe' => ['first' => 'John', 'last' => 'Doe'],
	'Hart' => ['first' => 'Alice', 'last' => 'Hart'],
	'Smith' => ['first' => 'Jane', 'last' => 'Smith'],
	'Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
	'Durst' => ['first' => 'Fred', 'last' => 'Durst'],
]
```

[↑ Top](#operations)

keys
---
[Operations](#operations) › [Iterable](#iterable)

```php
keys($iterable): array

# Curried: (all parameters required)
Curry\keys($iterable)
```
Gets the keys of `$iterable` as an array.

Related: `values()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `array` | 

**Example:** 
```php
Dash\keys(['c' => 3, 'a' => 1, 'b' => 2]);
// === ['c', 'a', 'b']
```

[↑ Top](#operations)

last
---
[Operations](#operations) › [Iterable](#iterable)

```php
last($iterable): mixed|null

# Curried: (all parameters required)
Curry\last($iterable)
```
Gets the value of the last element in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\last(['a' => 'one', 'b' => 'two', 'c' => 'three']);
// === 'three'

Dash\last([]);
// === null
```

[↑ Top](#operations)

map
---
[Operations](#operations) › [Iterable](#iterable)

```php
map($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\map($iteratee, $iterable)
```
Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.

Keys in `$iterable` are not preserved. To preserve keys, use `mapValues()` instead.

Related: `mapValues()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable\|string\|numeric` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will use `Dash\property($iteratee)` as the iteratee
**Returns** | `array` | A new 0-indexed array

**Example:** 
```php
Dash\map(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
	return $value * 2;
});
// === [2, 4, 6]

```

**Example:** With a path `$iteratee`
```php
$data = [
	'jdoe' => ['name' => ['first' => 'John', 'last' => 'Doe']],
	'mjane' => ['name' => ['first' => 'Mary', 'last' => 'Jane']],
	'psmith' => ['name' => ['first' => 'Pete', 'last' => 'Smith']],
];
Dash\map($data, 'name.last');
// === ['Doe', 'Jane', 'Smith']
```

[↑ Top](#operations)

mapValues
---
[Operations](#operations) › [Iterable](#iterable)

```php
mapValues($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\mapValues($iteratee, $iterable)
```
Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.

Unlike `map()`, keys in `$iterable` are preserved.

Related: `map()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable\|string` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will use `Dash\property($iteratee)` as the iteratee
**Returns** | `array` | A new 0-indexed array

**Example:** 
```php
Dash\mapValues(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
	return $value * 2;
});
// === ['a' => 2, 'b' => 4, 'c' => 6]

```

**Example:** With a path `$iteratee`
```php
$data = [
	'jdoe' => ['name' => ['first' => 'John', 'last' => 'Doe']],
	'mjane' => ['name' => ['first' => 'Mary', 'last' => 'Jane']],
	'psmith' => ['name' => ['first' => 'Pete', 'last' => 'Smith']],
];
Dash\mapValues($data, 'name.last');
// === ['jdoe' => 'Doe', 'mjane' => 'Jane', 'psmith' => 'Smith']
```

[↑ Top](#operations)

matchesProperty
---
[Operations](#operations) › [Iterable](#iterable)

```php
matchesProperty($path, $value = true, $comparator = 'Dash\equal'): function

# Curried: (all parameters required)
Curry\matchesProperty($value, $comparator, $path)
```
Creates a function that returns whether `$comparator` returns truthy for the value at `$path` for a given input.



Parameter | Type | Description
--- | --- | :---
`$path` | `callable\|string\|number\|null` | Any valid path supported by `Dash\get()`
`$value` | `mixed` | Value passed to `$comparator` for comparison
`$comparator` | `callable` | (optional) Function with signature `($valueAtPath, $value)` that compares `$value` to the value at `$path` for the given input
**Returns** | `function` | Function with signature `($input)` that returns whether the value at `$path` within `$input`

**Example:** Matches truthy field value
```php
$matcher = Dash\matchesProperty('foo');
$matcher(['foo' => 'bar']);  // === true
$matcher(['foo' => null]);   // === false

```

**Example:** Matches falsey field value
```php
$matcher = Dash\matchesProperty('foo', false);
$matcher(['foo' => false]);  // === true
$matcher(['foo' => 'bar']);  // === false

```

**Example:** Matches field value that loosely equals a given value
```php
$matcher = Dash\matchesProperty('foo', 3);
$matcher(['foo' => 3.0]);  // === true
$matcher(['foo' => 4]);   // === false

```

**Example:** Matches field value for which a given comparator returns true
```php
$matcher = Dash\matchesProperty('foo', 3, 'Dash\identical');
$matcher(['foo' => 3]);    // === true
$matcher(['foo' => 3.0]);  // === false
```

[↑ Top](#operations)

max
---
[Operations](#operations) › [Iterable](#iterable)

```php
max($iterable): mixed|null

# Curried: (all parameters required)
Curry\max($iterable)
```
Gets the maximum value of all elements in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\max([3, 8, 2, 5]);
// === 8

Dash\max([]);
// === null
```

[↑ Top](#operations)

median
---
[Operations](#operations) › [Iterable](#iterable)

```php
median($iterable): mixed|null

# Curried: (all parameters required)
Curry\median($iterable)
```
Returns the median value of an iterable.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\median([3, 2, 1, 5, 4]);
// === 3

Dash\median([3, 2, 1, 4]);
// === 2.5
```

[↑ Top](#operations)

min
---
[Operations](#operations) › [Iterable](#iterable)

```php
min($iterable): mixed|null

# Curried: (all parameters required)
Curry\min($iterable)
```
Gets the minimum value of all elements in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `mixed\|null` | Null if `$iterable` is empty

**Example:** 
```php
Dash\min([3, 8, 2, 5]);
// === 2

Dash\min([]);
// === null
```

[↑ Top](#operations)

omit
---
[Operations](#operations) › [Iterable](#iterable)

```php
omit($iterable, $keys): array

# Curried: (all parameters required)
Curry\omit($keys, $iterable)
```
Gets the elements of `$iterable` with keys that match any in `$keys`.
The opposite of `pick()`.

Related: `pick()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$keys` | `string\|array` | Single key or list of keys
**Returns** | `array` | 

**Example:** 
```php
Dash\omit(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']);
// === ['a' => 1, 'd' => 4]
```

[↑ Top](#operations)

pick
---
[Operations](#operations) › [Iterable](#iterable)

```php
pick($iterable, $keys): array

# Curried: (all parameters required)
Curry\pick($keys, $iterable)
```
Gets the elements of `$iterable` with keys that match any in `$keys`.

Related: `omit()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$keys` | `string\|array` | Single key or list of keys
**Returns** | `array` | 

**Example:** 
```php
Dash\pick(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']);
// === ['b' => 2, 'c' => 3]
```

[↑ Top](#operations)

pluck
---
[Operations](#operations) › [Iterable](#iterable)

```php
pluck($iterable, $path, $default = null): array

# Curried: (all parameters required)
Curry\pluck($path, $default, $iterable)
```
Gets an array of values at `$path` for all elements in `$iterable`.

Related: `map()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$path` | `callable` | Any valid path accepted by `Dash\property()`
`$default` | `mixed` | (optional) Default value for each element without a value at `$path`
**Returns** | `array` | New array of plucked values from `$iterable`

**Example:** 
```php
$data = [
	['name' => 'John'],
	['name' => 'Mary', 'age' => 35],
	['name' => 'Pete', 'age' => 20],
];

Dash\pluck($data, 'name');
// === ['John', 'Mary', 'Pete']

Dash\pluck($data, 'age');
// === [null, 35, 20]
```

[↑ Top](#operations)

property
---
[Operations](#operations) › [Iterable](#iterable)

```php
property($path, $default = null): function

# Curried: (all parameters required)
Curry\property($default, $path)
```
Creates a function that returns the value at a `$path` for a given input.



Parameter | Type | Description
--- | --- | :---
`$path` | `string\|number\|null` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period.
`$default` | `mixed` | (optional) Default value to return if nothing exists at `$path`
**Returns** | `function` | Function with signature `($input)` that returns the value at `$path` within `$input`

**Example:** Accepts arrays and objects
```php
$getter = Dash\property('foo');
$getter(['foo' => 'value']);  // === 'value'
$getter((object) ['foo' => 'value']);  // === 'value'

```

**Example:** Methods can be accessed too
```php
$getter = Dash\property('items.count');
$countFn = $getter(['items' => new ArrayObject([1, 2, 3])]);
$countFn();  // === 3

```

**Example:** Nested properties can be referenced with dot notation
```php
$getter = Dash\property('a.b.c');
$getter([
	'a' => [
		'b' => [
			'c' => 'value'
		]
	]
]);
// === 'value'

```

**Example:** Array elements can be referenced by index
```php
$getter = Dash\property('items.1.name');
$getter([
	'items' => [
		['name' => 'one'],
		['name' => 'two'],
		['name' => 'three'],
	]
]);
// === 'two'

```

**Example:** Keys with the same name as the full path can be used
```php
$getter = Dash\property('a.b.c');
$getter(['a.b.c' => 'value']);  // === 'value'
```

[↑ Top](#operations)

reduce
---
[Operations](#operations) › [Iterable](#iterable)

```php
reduce($iterable, $iteratee, $initial = []): mixed

# Curried: (all parameters required)
Curry\reduce($iteratee, $initial, $iterable)
```
Iteratively reduces `$iterable` to a single value by way of `$iteratee`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$iteratee` | `callable` | Called with `($result, $value, $key)` for each `($key, $value)` in `$iterable` and the current accumulated `$result`. `$iteratee` should return the updated `$result`
`$initial` | `mixed` | (optional) Initial value
**Returns** | `mixed` | 

**Example:** Computes the sum of an array's values
```php
Dash\reduce([1, 2, 3, 4], function ($sum, $value) {
	return $sum + $value;
}, 0);
// === 10
```

[↑ Top](#operations)

reject
---
[Operations](#operations) › [Iterable](#iterable)

```php
reject($iterable, $predicate = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\reject($predicate, $iterable)
```
Gets a list of elements in `$iterable` for which `$predicate` returns falsey.
The opposite of `filter()`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)

Related: `filter()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$predicate` | `callable\|string\|array` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will get elements with a falsey value for that field/index; if an array of form `[$field, $value]`, will get elements where the field/index does not loosely equal `$value`
**Returns** | `array` | List of elements in `$iterable` that do not satisfy `$predicate`

**Example:** 
```php
Dash\reject([1, 2, 3, 4], 'Dash\isOdd');
// === [2, 4]

Dash\reject(
	[3 => 'c', 1 => 'a', 2 => 'b'],
	function ($value, $key) { return $key <= 1; }
);
// === [3 => 'c', 2 => 'b']

```

**Example:** The default predicate checks truthiness
```php
Dash\reject([1, 2, null, 3, false, true]);
// === [null, false]

```

**Example:** With a field/value
```php
$data = [
	['name' => 'John', 'active' => false],
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true],
];

Dash\reject($data, 'active');
// === [
	['name' => 'John', 'active' => false],
]

Dash\reject($data, ['active', false]);
// === [
	['name' => 'Mary', 'active' => true],
	['name' => 'Pete', 'active' => true]
]
```

[↑ Top](#operations)

reverse
---
[Operations](#operations) › [Iterable](#iterable)

```php
reverse($iterable, $preserveIntegerKeys = false): array

# Curried: (all parameters required)
Curry\reverse($preserveIntegerKeys, iterable)
```
Gets a new array of `$iterable` elements in reverse order.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$preserveIntegerKeys` | `boolean` | (optional) If true, integer keys will be preserved; non-integer keys are always preserved regardless of this setting
**Returns** | `array` | New array of `$iterable` elements in reverse order

**Example:** 
```php
Dash\reverse(['a', 'b', 'c']);
// === ['c', 'b', 'a']

Dash\reverse(['a' => 1, 'b' => 2, 'c' => 3]);
// === ['c' => 3, 'b' => 2, 'a' => 1]

```

**Example:** Preserving integer keys
```php
Dash\reverse(['a', 'b', 'c'], true);
// === [2 => 'c', 1 => 'b', 0 => 'a']

Dash\reverse(['a', 'b', 'c'], false);
// === [0 => 'c', 1 => 'b', 2 => 'a']
```

[↑ Top](#operations)

rotate
---
[Operations](#operations) › [Iterable](#iterable)

```php
rotate($iterable, $count = 1): array

# Curried: (all parameters required)
Curry\rotate($count, $iterable)
```
Gets a new array of `$iterable` elements where `$count` elements are moved counter-clockwise
from the beginning of `$iterable` to the end.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$count` | `integer` | If negative, moves `$count` elements from the end to the beginning
**Returns** | `array` | New array of rotated elements

**Example:** 
```php
Dash\rotate(['a', 'b', 'c', 'd', 'e'], 2);
// === ['c', 'd', 'e', 'a', 'b']

Dash\rotate(['a' => 1, 'b' => 2, 'c' => 3], 1);
// === ['b' => 2, 'c' => 3, 'a' => 1]

Dash\rotate(['a', 'b', 'c', 'd', 'e'], -1);
// === ['e', 'a', 'b', 'c', 'd']
```

[↑ Top](#operations)

sort
---
[Operations](#operations) › [Iterable](#iterable)

```php
sort($iterable, $comparator = 'Dash\compare'): array

# Curried: (all parameters required)
Curry\sort($comparator, $iterable)
```
Gets a new array containing the sorted elements of `$iterable`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$comparator` | `callable` | (optional) Invoked with `($a, $b)` where `$a` and `$b` are values in `$iterable`; `$comparator` should returns a number less than, equal to, or greater than zero if `$a` is less than, equal to, or greater than `$b`, respectively
**Returns** | `array` | New array of `$iterable` elements ordered by `$comparator`

**Example:** 
```php
Dash\sort([4, 2, 3, 1]);
// === [1, 2, 3, 4]

Dash\sort(['a' => 3, 'b' => 1, 'c' => 2]);
// === ['b' => 1, 'c' => 2, 'a' => 3]
```

[↑ Top](#operations)

sum
---
[Operations](#operations) › [Iterable](#iterable)

```php
sum($iterable): numeric

# Curried: (all parameters required)
Curry\sum($iterable)
```
Gets the sum of all element values in `$iterable`.



Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `numeric` | Zero if `$iterable` is empty

**Example:** 
```php
Dash\sum([2, 3, 5, 8]);
// === 18

Dash\sum([]);
// === 0
```

[↑ Top](#operations)

take
---
[Operations](#operations) › [Iterable](#iterable)

```php
take($iterable, $count = 1): array|iterable

# Curried: (all parameters required)
Curry\take($count, $iterable)
```
Gets a new array of the first `$count` elements of `$iterable`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)

Related: `takeRight()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$count` | `integer` | If negative, gets all but the last `$count` elements of `$iterable`
**Returns** | `array\|iterable` | New array of `$count` elements

**Example:** 
```php
Dash\take([2, 3, 5, 8, 13], 3);
// === [2, 3, 5]

Dash\take(['b' => 2, 'c' => 3, 'a' => 1], 2);
// === ['b' => 2, 'c' => 3]

Dash\take([1, 2, 3, 4, 5, 6], -2);
// === [1, 2, 3, 4]
```

[↑ Top](#operations)

takeRight
---
[Operations](#operations) › [Iterable](#iterable)

```php
takeRight($iterable, $count = 1): array

# Curried: (all parameters required)
Curry\takeRight($count, $iterable)
```
Gets a new array of the last `$count` elements of `$iterable`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)

Related: `take()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
`$count` | `integer` | If negative, gets all but the first `$count` elements of `$iterable`
**Returns** | `array` | New array of `$count` elements

**Example:** 
```php
Dash\take([2, 3, 5, 8, 13], 3);
// === [5, 8, 13]

Dash\take(['b' => 2, 'c' => 3, 'a' => 1], 2);
// === ['c' => 3, 'a' => 1]

Dash\take([1, 2, 3, 4, 5, 6], -2);
// === [3, 4, 5, 6]
```

[↑ Top](#operations)

toArray
---
[Operations](#operations) › [Iterable](#iterable)

```php
toArray($value): array

# Curried: (all parameters required)
Curry\toArray($value)
```
Gets an array representation of `$value`.



Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
**Returns** | `array` | Empty array if `$value` is not iterable

**Example:** 
```php
Dash\toArray((object) ['a' => 1, 'b' => 2]);
// === ['a' => 1, 'b' => 2]

Dash\toArray(new FilesystemIterator(__DIR__));
// === [ SplFileInfo, SplFileInfo, ... ]
```

[↑ Top](#operations)

toObject
---
[Operations](#operations) › [Iterable](#iterable)

```php
toObject($value): object

# Curried: (all parameters required)
Curry\toObject($value)
```
Gets a plain object representation of `$value`.



Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | 
**Returns** | `object` | Empty object if `$value` is not iterable

**Example:** 
```php
Dash\toObject(['a' => 1, 'b' => 2]);
// === (object) ['a' => 1, 'b' => 2]

Dash\toObject(new ArrayObject(['a' => 1, 'b' => 2]));
// === (object) ['a' => 1, 'b' => 2]
```

[↑ Top](#operations)

union
---
[Operations](#operations) › [Iterable](#iterable)

```php
union($iterable /*, ...iterables */): array
```
Returns a new array containing the combined set of unique values, in order, of all provided iterables.

Non-indexed keys are preseved, but duplicate keys will overwrite previous ones.

Related: `intersection()`, `difference()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | (variadic) One or more iterables to merge
**Returns** | `array` | 

**Example:** With indexed arrays
```php
Dash\union(
	[1, 3, 5],
	[2, 4, 6],
	[7, 8]
);
// === [1, 3, 5, 2, 4, 6, 7, 8]

```

**Example:** With associative arrays
```php
Dash\union(
	['a' => 1, 'c' => 3],
	['b' => 2, 'd' => 4],
	['e' => 5, 'f' => 6]
);
// === ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6]
```

[↑ Top](#operations)

values
---
[Operations](#operations) › [Iterable](#iterable)

```php
values($iterable): array

# Curried: (all parameters required)
Curry\values($iterable)
```
Gets the values of `$iterable` as an array.

Related: `keys()`

Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | 
**Returns** | `array` | 

**Example:** 
```php
Dash\values(['c' => 3, 'a' => 1, 'b' => 2]);
// === [3, 1, 2]
```

[↑ Top](#operations)

Utility
===

assertType
---
[Operations](#operations) › [Utility](#utility)

```php
assertType($value, $type, $funcName = __FUNCTION__): void

# Curried: (all parameters required)
Curry\assertType($type, $funcName, input)
```
Throws an `InvalidArgumentException` exception if `$value` is not of type `$type`.
If `$value` is an accepted type, this function is a no-op.

Related: `isType()`

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

[↑ Top](#operations)

chain
---
[Operations](#operations) › [Utility](#utility)

```php
chain($input = null): Dash\_

# Curried: (all parameters required)
Curry\chain($input)
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

[↑ Top](#operations)

compare
---
[Operations](#operations) › [Utility](#utility)

```php
compare($a, $b): integer

# Curried: (all parameters required)
Curry\compare($b, $a)
```
Returns a number less than, equal to, or greater than zero
if `$a` is less than, equal to, or greater than `$b`, respectively.

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

[↑ Top](#operations)

custom
---
[Operations](#operations) › [Utility](#utility)

```php
custom($name): function

# Curried: (all parameters required)
Curry\custom($name)
```
Gets a custom operation by name.



Parameter | Type | Description
--- | --- | :---
`$name` | `string` | Name of the custom operation
**Returns** | `function` | The custom operation

**Example:** 
```php
_::setCustom('double', function ($n) { return $n * 2; });

$double = Dash\custom('double');
$double(3);
// === 6

_::chain([1, 2, 3])->map(Dash\custom('double'))->value();
// === [2, 4, 6]
```

[↑ Top](#operations)

debug
---
[Operations](#operations) › [Utility](#utility)

```php
debug($value /*, ...value */): mixed

# Curried: (all parameters required)
Curry\debug(...value)
```
Prints debugging information for one or more values.



Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` | (variadic) One or more values to debug
**Returns** | `mixed` | The first argument

**Example:** 
```php
Dash\debug([1, 2, 3], 'hello', null);
// === [1, 2, 3]

// Prints:
array (
  0 => 1,
  1 => 2,
  2 => 3,
)
'hello'
NULL

@codeCoverageIgnore Due to output buffering
```

[↑ Top](#operations)

equal
---
[Operations](#operations) › [Utility](#utility)

```php
equal($a, $b): boolean

# Curried: (all parameters required)
Curry\equal($b, $a)
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

[↑ Top](#operations)

get
---
[Operations](#operations) › [Utility](#utility)

```php
get($input, $path, $default = null): mixed

# Curried: (all parameters required)
Curry\get($path, $default, $input)
```
Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.

Related: `getDirect()`, `has()`, `property()`

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$path` | `callable\|string\|number` | If a callable, invoked with `($input)` to get the value at `$path`; if a string or number, `Dash\property($path)` used to get the value at `$path`
`$default` | `mixed` | (optional) Value to return if `$path` does not exist within `$input`
**Returns** | `mixed` | Value at `$path` or `$default` if no value exists

**Example:** 
```php
$input = [
	'people' => [
		['name' => 'Pete'],
		['name' => 'John'],
		['name' => 'Mark'],
	]
];
Dash\get($input, 'people.2.name');
// === 'Mark'

```

**Example:** Direct properties take precedence over nested ones
```php
$input = [
	'a.b.c' => 'direct',
	'a' => ['b' => ['c' => 'nested']]
];
Dash\get($input, 'a.b.c');
// === 'direct'
```

[↑ Top](#operations)

getDirect
---
[Operations](#operations) › [Utility](#utility)

```php
getDirect($input, $key, $default = null): mixed

# Curried: (all parameters required)
Curry\getDirect($key, $default, $iterable)
```
Gets the array value, object property, or method at `$key` within `$input`.

If an array offset, object property, and/or method all exist for the same key,
the value at the array offset takes precedence and will be returned.

Related: `getDirectRef()`, `hasDirect()`, `get()`

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$key` | `string` | Array offset, object property name, or method name
`$default` | `mixed` | (optional) Value to return if `$input` has nothing at `$key`
**Returns** | `mixed` | 

**Example:** 
```php
Dash\getDirect(['a' => 'one', 'b' => 'two'], 'b');
// === 'two'

Dash\getDirect((object) ['a' => 'one', 'b' => 'two'], 'b');
// === 'two'

$count = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
$count();
// === 3

```

**Example:** Array offsets take precedence over object properties
```php
$input = new ArrayObject(['a' => 'array value']);
$input->a = 'object value';

Dash\getDirect($input, 'a');
// === 'array value'
```

[↑ Top](#operations)

getDirectRef
---
[Operations](#operations) › [Utility](#utility)

```php
getDirectRef(&$input, $key): mixed
```
Similar to `getDirect()`, but returns a reference to the value at `$key` within `$input`.

Related: `getDirect()`, `hasDirect()`

Parameter | Type | Description
--- | --- | :---
`$input` | `array\|object\|ArrayAccess` | 
`$key` | `string` | Array offset or object property name
**Returns** | `mixed` | Reference to `$key` within `$input`

**Example:** 
```php
$array = ['key' => 'value'];
$ref = &Dash\getDirectRef($array, 'key');
$ref = 'changed';
// $array['key'] === 'changed'

$object = (object) ['key' => 'value'];
$ref = &Dash\getDirectRef($object, 'key');
$ref = 'changed';
// $object->key === 'changed'
```

[↑ Top](#operations)

hasDirect
---
[Operations](#operations) › [Utility](#utility)

```php
hasDirect($input, $key): boolean

# Curried: (all parameters required)
Curry\hasDirect($key, $input)
```
Checks whether an array value, object property, or method exists at `$key` within `$input`.

Related: `getDirect()`

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$key` | `string` | Array offset, object property name, or method name
**Returns** | `boolean` | 

**Example:** 
```php
Dash\hasDirect(['a' => 1, 'b' => 2], 'a');
// === true

Dash\hasDirect(['a' => 1, 'b' => 2], 'x');
// === false

Dash\hasDirect((object) ['a' => 1, 'b' => 2], 'a');
// === true

Dash\hasDirect(new DateTime(), 'getTimestamp');
// === true
```

[↑ Top](#operations)

identical
---
[Operations](#operations) › [Utility](#utility)

```php
identical($a, $b): boolean

# Curried: (all parameters required)
Curry\identical($b, $a)
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

[↑ Top](#operations)

identity
---
[Operations](#operations) › [Utility](#utility)

```php
identity($value): mixed

# Curried: (all parameters required)
Curry\identity($value)
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

[↑ Top](#operations)

isEmpty
---
[Operations](#operations) › [Utility](#utility)

```php
isEmpty($value): boolean

# Curried: (all parameters required)
Curry\isEmpty($value)
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

[↑ Top](#operations)

isType
---
[Operations](#operations) › [Utility](#utility)

```php
isType($value, $type): boolean

# Curried: (all parameters required)
Curry\isType($type, $value)
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

[↑ Top](#operations)

result
---
[Operations](#operations) › [Utility](#utility)

```php
result($input, $path, $default = null): mixed

# Curried: (all parameters required)
Curry\result($path, $default, $input)
```
Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
Like `get()` but if the value is callable, it is invoked and its return value is returned.

Related: `get()`, `property()`

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$path` | `callable\|string` | If a callable, invoked with `($input)` to get the value at `$path`; if a string, will use `Dash\property($path)` to get the value at `$path`
`$default` | `mixed` | (optional) Value to return if `$path` does not exist within `$input`
**Returns** | `mixed` | Value at `$path` or `$default` if no value exists

**Example:** 
```php
$input = [
	'people' => new ArrayObject([
		['name' => 'Pete', 'getHash' => function () { return '4d17a4'; }],
		['name' => 'John', 'getHash' => function () { return 'fd2a48'; }],
		['name' => 'Paul', 'getHash' => function () { return 'd8575d'; }],
	])
];

Dash\result($input, 'people.1.name');
// === 'John'

Dash\result($input, 'people.count');
// === 3

Dash\result($input, 'people.1.joined.getTimestamp');
// === 'fd2a48'
```

[↑ Top](#operations)

set
---
[Operations](#operations) › [Utility](#utility)

```php
set(&$input, $path, $value): mixed
```
Sets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
Note: This *will* modify `$input`.

Related: `get()`, `getDirect()`, `property()`

Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | 
`$path` | `string` | Path at which to set `$value`; can be a nested path (eg. `a.b.0.c`). Intermediate arrays or objects will be created where missing (see examples)
`$value` | `mixed` | Value to set at $path
**Returns** | `mixed` | `$input`, modified

**Example:** 
```php
$input = (object) [
	'a' => [1, 2],
	'b' => [3, 4],
	'c' => [5, 6],
];
Dash\set($input, 'a', [7, 8, 9]);
Dash\set($input, 'b.0', 10);

// $input === (object) [
	'a' => [7, 8, 9],
	'b' => [10, 4],
	'c' => [5, 6],
]

```

**Example:** Intermediate array/objects are created if missing
```php
$input = ['a' => []];
Dash\set($input, 'a.b.c', 'value');

// $input === [
	'a' => [
		'b' => [
			'c' => 'value'
		]
	]
]

$input = ['a' => (object) []];
Dash\set($input, 'a.b.c', 'value');

// $input === [
	'a' => (object) [
		'b' => (object) [
			'c' => 'value'
		]
	]
]
```

[↑ Top](#operations)

size / count
---
[Operations](#operations) › [Utility](#utility)

```php
size($value, $encoding = 'UTF-8'): integer

# Curried: (all parameters required)
Curry\size($value)
```
Gets the number of items in `$value`.

For iterables, this is the number of elements.
For strings, this is number of characters.



Parameter | Type | Description
--- | --- | :---
`$value` | `iterable\|string` | 
`$encoding` | `string` | (optional) The character encoding of `$value` if it is a string; see `mb_list_encodings()` for the list of supported encodings
**Returns** | `integer` | Size of `$value` or zero if `$value` is neither iterable nor a string

**Example:** 
```php
Dash\size([1, 2, 3]);
// === 3

Dash\size('Beyoncé');
// === 7
```

[↑ Top](#operations)

tap
---
[Operations](#operations) › [Utility](#utility)

```php
tap($value, callable $interceptor): mixed

# Curried: (all parameters required)
Curry\tap($interceptor, $value)
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

[↑ Top](#operations)

thru
---
[Operations](#operations) › [Utility](#utility)

```php
thru($value, callable $interceptor): mixed

# Curried: (all parameters required)
Curry\thru($interceptor, $value)
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

[↑ Top](#operations)

Callable
===

apply
---
[Operations](#operations) › [Callable](#callable)

```php
apply(callable $callable, $args): mixed

# Curried: (all parameters required)
Curry\apply($callable, $args)
```
Invokes `$callable` with a list of arguments.

Note: Contrary to other curried operations, the curried version of this operation
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

$apply = Dash\Curry\apply($func);

$apply(['morning', 'John']);
// === 'Good morning, John'
```

[↑ Top](#operations)

ary
---
[Operations](#operations) › [Callable](#callable)

```php
ary(callable $callable, $arity): callable

# Curried: (all parameters required)
Curry\ary($arity, $callable)
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

[↑ Top](#operations)

call
---
[Operations](#operations) › [Callable](#callable)

```php
call(callable $callable /*, ...args */): mixed
```
Invokes `$callable` with an inline list of arguments.



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

[↑ Top](#operations)

currify
---
[Operations](#operations) › [Callable](#callable)

```php
currify(callable $callable, array $args = [], $rotate = 1): function|mixed
```
Creates a new, curried version of `$callable` where the first `$rotate` arguments
are moved to the end of the arguments list.

In essence, this takes a data-first function and returns a curryable data-last function.

Related: `currifyN()`, `curry()`, `partial()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$args` | `array` | (optional) Initial arguments to pass to the final curried function
`$rotate` | `integer` | (optional) The number of arguments to move from start to end; see Dash\rotate()
**Returns** | `function\|mixed` | 

**Example:** 
```php
$greet = function ($name, $greeting, $punctuation) {
	return "$greeting, $name$punctuation";
};

$goodMorning = Dash\currify($greet, ['Good morning', '!']);
$goodMorning('John')
// === 'Good morning, John!'

```

**Example:** With a custom `$rotate`
```php
$greet = function ($salutation, $name, $greeting, $punctuation) {
	return "$greeting, $salutation $name$punctuation";
};

$goodMorning = Dash\currify($greet, ['Good morning', '!'], 2);
$goodMorning('Sir', 'John')
// === 'Good morning, Sir John!'
```

[↑ Top](#operations)

currifyN
---
[Operations](#operations) › [Callable](#callable)

```php
currifyN(callable $callable, $totalArgs, array $args = [], $rotate = 1): function|mixed
```
Creates a new, curried version of `$callable` where the first `$rotate` of `$totalArgs` arguments
are moved to the end of the arguments list.

In essence, this takes a data-first function and returns a curryable data-last function.

Related: `currify()`, `curry()`, `partial()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$totalArgs` | `integer` | Total number of arguments accepted by `$callable`
`$args` | `array` | (optional) Initial arguments to pass to the final curried function
`$rotate` | `integer` | (optional) The number of arguments to move from start to end; see Dash\rotate()
**Returns** | `function\|mixed` | 



[↑ Top](#operations)

curry
---
[Operations](#operations) › [Callable](#callable)

```php
curry(callable $callable /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.

Related: `curryN()`, `curryRight()`, `partial()`, `currify()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | Any valid callable except for relative static methods, eg. ['A', 'parent::foo']
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
**Returns** | `function\|mixed` | 

**Example:** 
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name";
};

$goodMorning = Dash\curry($greet, 'Good morning');
$goodMorning('Ms.', 'Mary');
// === 'Good morning, Ms. Mary'

$goodMorning = Dash\curry($greet, 'Good morning');
$goodMorningSir = $goodMorning('Sir');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter'

```

**Example:** With placeholders
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name";
};

$greetMary = Dash\curry($greet, Dash\_, 'Ms.', 'Mary');
$greetMary('Good morning');
// === 'Good morning, Ms. Mary'

$greetSir = Dash\curry($greet, Dash\_, 'Sir');
$goodMorningSir = $greetSir('Good morning');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter'
```

[↑ Top](#operations)

curryN
---
[Operations](#operations) › [Callable](#callable)

```php
curryN(callable $callable, $numRequiredArgs /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.

Related: `curry()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$numRequiredArgs` | `integer` | The number of parameters to require before calling `$callable`
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
**Returns** | `function\|mixed` | 

**Example:** 
```php
$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
	return "$greeting, $salutation $name$punctuation";
};

$goodMorning = Dash\curryN($greet, 3, 'Good morning');
$goodMorning('Ms.', 'Mary');
// === 'Good morning, Ms. Mary!'

$goodMorning = Dash\curryN($greet, 3, 'Good morning');
$goodMorningSir = $goodMorning('Sir');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter!'

```

**Example:** With placeholders
```php
$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
	return "$greeting, $salutation $name$punctuation";
};

$greetSir = Dash\curryN($greet, 3, Dash\_, 'Sir');
$goodMorningSir = $greetSir('Good morning');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter!'

$greetMary = Dash\curryN($greet, 3, Dash\_, Dash\_, 'Mary');
$greetMsMary = $greetMary(Dash\_, 'Ms.');
$greetMsMary('Good morning');
// === 'Good morning, Ms. Mary!'
```

[↑ Top](#operations)

curryRight
---
[Operations](#operations) › [Callable](#callable)

```php
curryRight(callable $callable /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Like `partialRight()`, arguments are applied in reverse order.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.

Related: `curry()`, `partial()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
**Returns** | `function\|mixed` | 

**Example:** 
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name";
};

$goodMorning = Dash\curryRight($greet, 'Good morning');
$goodMorning('Ms.', 'Mary');
// === 'Good morning, Ms. Mary'

$goodMorning = Dash\curryRight($greet, 'Good morning');
$goodMorningSir = $goodMorning('Sir');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter'

```

**Example:** With placeholders
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name";
};

$greetMary = Dash\curryRight($greet, Dash\_, 'Ms.', 'Mary');
$greetMary('Good morning');
// === 'Good morning, Ms. Mary'

$greetSir = Dash\curryRight($greet, Dash\_, 'Sir');
$goodMorningSir = $greetSir('Good morning');
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter'
```

[↑ Top](#operations)

curryRightN
---
[Operations](#operations) › [Callable](#callable)

```php
curryRightN(callable $callable, $numRequiredArgs /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Like `partialRight()`, arguments are applied in reverse order.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.

Related: `curryN()`, `partialRight()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`$numRequiredArgs` | `integer` | The number of parameters to require before calling `$callable`
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
**Returns** | `function\|mixed` | 

**Example:** 
```php
$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
	return "$greeting, $salutation $name$punctuation";
};

$greetMary = Dash\curryRightN($greet, 3, 'Mary');
$greetMsMary = $greetMary('Ms.');
$greetMsMary('Good morning');
// === 'Good morning, Ms. Mary!

$greetPeter = Dash\curryRightN($greet, 3, 'Peter');
$greetSirPeter = $greetPeter('Sir');
$greetSirPeter('Good morning');
// === 'Good morning, Sir Peter!

```

**Example:** With placeholders
```php
$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
	return "$greeting, $salutation $name$punctuation";
};

$goodMorning = Dash\curryRightN($greet, 3, 'Good morning', Dash\_, Dash\_);
$goodMorningSir = $goodMorning('Sir', Dash\_);
$goodMorningSir('Peter');
// === 'Good morning, Sir Peter!

$greetMs = Dash\curryRightN($greet, 3, 'Ms.', Dash\_);
$goodMorningMs = $greetMs('Good morning', Dash\_);
$goodMorningMs('Mary');
// === 'Good morning, Ms. Mary!
```

[↑ Top](#operations)

negate
---
[Operations](#operations) › [Callable](#callable)

```php
negate(callable $predicate): callable

# Curried: (all parameters required)
Curry\negate($predicate)
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

[↑ Top](#operations)

partial
---
[Operations](#operations) › [Callable](#callable)

```php
partial($callable /*, ...args */): callable
```
Creates a new function that will invoke `$callable` with the given arguments
and any others passed to the returned function.

When calling `$callable`, arguments provided to `partial()` will be listed
BEFORE those passed to the returned function.

Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.

Related: `partialRight()`, `curry()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
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

**Example:** With placeholders
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};

$greetMark = Dash\partial($greet, Dash\_, 'Mark');
$greetJane = Dash\partial($greet, Dash\_, 'Jane');

$greetMark('Hello');  // === 'Hello, Mark!'
$greetJane('Howdy');  // === 'Howdy, Jane!'
```

[↑ Top](#operations)

partialRight
---
[Operations](#operations) › [Callable](#callable)

```php
partialRight($callable /*, ...args */): callable
```
Creates a new function that will invoke `$callable` with the given arguments
and any others passed to the returned function.

When calling `$callable`, arguments provided to `partial()` will be listed
AFTER those passed to the returned function.

Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.

Related: `partial()`, `curryRight()`

Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` | 
`...$args` | `mixed` | (optional, variadic) arguments to pass to `$callable`
**Returns** | `callable` | 

**Example:** 
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};

$greetMark = Dash\partialRight($greet, 'Mark');
$greetJane = Dash\partialRight($greet, 'Jane');

$greetMark('Hello');  // === 'Hello, Mark!'
$greetJane('Howdy');  // === 'Howdy, Jane!'

```

**Example:** With a placeholder
```php
$greet = function ($greeting, $name) {
	return "$greeting, $name!";
};

$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

$sayHello('Mark');  // === 'Hello, Mark!'
$sayHowdy('Jane');  // === 'Howdy, Jane!'
```

[↑ Top](#operations)

unary
---
[Operations](#operations) › [Callable](#callable)

```php
unary(callable $callable): callable

# Curried: (all parameters required)
Curry\unary($callable)
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

[↑ Top](#operations)

Number
===

isEven
---
[Operations](#operations) › [Number](#number)

```php
isEven($value): boolean

# Curried: (all parameters required)
Curry\isEven($value)
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

[↑ Top](#operations)

isOdd
---
[Operations](#operations) › [Number](#number)

```php
isOdd($value): boolean

# Curried: (all parameters required)
Curry\isOdd($value)
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

[↑ Top](#operations)
