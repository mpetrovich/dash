Operations
===
Is there an operation you'd like to see? [Open an issue](https://github.com/mpetrovich/dash/issues/new?labels=enhancement) or vote on an existing one.

Operation | Signature | Curried
:--- | :--- | :---
[all](#all--every) / every | `all($iterable, $predicate = 'Dash\identity'): boolean` | `Curry\all`
[allPass](#allpass--overevery) / overEvery | `allPass($predicates): callable` | 
[any](#any--some) / some | `any($iterable, $predicate = 'Dash\identity'): boolean` | `Curry\any`
[anyPass](#anypass--oversome) / overSome | `anyPass($predicates): callable` | 
[apply](#apply) | `apply(callable $callable, $args): mixed` | `Curry\apply`
[ary](#ary) | `ary(callable $callable, $arity): callable` | `Curry\ary`
[assertType](#asserttype) | `assertType($value, $type, $funcName = __FUNCTION__): void` | `Curry\assertType`
[at](#at) | `at($iterable, $index, $default = null): mixed` | `Curry\at`
[average](#average--mean) / mean | `average($iterable): double\|null` | `Curry\average`
[call](#call) | `call(callable $callable /*, ...args */): mixed` | 
[chain](#chain) | `chain($input = null): Dash\Dash` | `Curry\chain`
[chunk](#chunk--splitevery) / splitEvery | `chunk($iterable, $size): array\|iterable` | `Curry\chunk`
[clamp](#clamp) | `clamp($number, $lower, $upper): numeric` | `Curry\clamp`
[compact](#compact) | `compact($iterable): array\|iterable` | `Curry\compact`
[compare](#compare) | `compare($a, $b): integer` | `Curry\compare`
[compose](#compose) | `compose(callable ...$fns): callable` | 
[cond](#cond) | `cond($pairs): callable` | 
[contains](#contains--includes) / includes | `contains($iterable, $target, $comparator = 'Dash\equal'): boolean` | `Curry\contains`
[converge](#converge) | `converge(callable $combiner, $branches): callable` | 
[countBy](#countby) | `countBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array` | `Curry\countBy`
[currify](#currify) | `currify(callable $callable, array $args = [], $rotate = 1): function\|mixed` | 
[currifyN](#currifyn) | `currifyN(callable $callable, $totalArgs, array $args = [], $rotate = 1): function\|mixed` | 
[curry](#curry) | `curry(callable $callable /*, ...args */): function\|mixed` | 
[curryN](#curryn) | `curryN(callable $callable, $numRequiredArgs /*, ...args */): function\|mixed` | 
[curryRight](#curryright) | `curryRight(callable $callable /*, ...args */): function\|mixed` | 
[curryRightN](#curryrightn) | `curryRightN(callable $callable, $numRequiredArgs /*, ...args */): function\|mixed` | 
[custom](#custom) | `custom($name): function` | `Curry\custom`
[debug](#debug) | `debug($value /*, ...value */): mixed` | `Curry\debug`
[defaults](#defaults) | `defaults($input /*, ...$sources */): array` | 
[deltas](#deltas) | `deltas($iterable): array` | `Curry\deltas`
[difference](#difference) | `difference($iterable /*, ...iterables */): array` | 
[differenceWith](#differencewith) | `differenceWith($iterable, $other, $comparator = 'Dash\equal'): array` | `Curry\differenceWith`
[dropWhile](#dropwhile) | `dropWhile($iterable, $predicate = 'Dash\identity'): array\|iterable` | `Curry\dropWhile`
[each](#each) | `each($iterable, $iteratee): mixed` | `Curry\each`
[equal](#equal) | `equal($a, $b): boolean` | `Curry\equal`
[evolve](#evolve) | `evolve($input, array $transformations): array\|object` | `Curry\evolve`
[filter](#filter) | `filter($iterable, $predicate = 'Dash\identity'): array\|iterable` | `Curry\filter`
[find](#find) | `find($iterable, $predicate = 'Dash\identity'): array\|null` | `Curry\find`
[findIndex](#findindex) | `findIndex($iterable, $predicate = 'Dash\identity'): integer` | `Curry\findIndex`
[findKey](#findkey) | `findKey($iterable, $predicate = 'Dash\identity'): string\|null` | `Curry\findKey`
[findLast](#findlast) | `findLast($iterable, $predicate = 'Dash\identity'): array\|null` | `Curry\findLast`
[findLastIndex](#findlastindex) | `findLastIndex($iterable, $predicate = 'Dash\identity'): integer` | `Curry\findLastIndex`
[findLastKey](#findlastkey) | `findLastKey($iterable, $predicate = 'Dash\identity'): string\|null` | `Curry\findLastKey`
[findLastValue](#findlastvalue) | `findLastValue($iterable, $predicate = 'Dash\identity'): mixed\|null` | `Curry\findLastValue`
[findValue](#findvalue) | `findValue($iterable, $predicate = 'Dash\identity'): mixed\|null` | `Curry\findValue`
[findWhere](#findwhere) | `findWhere($iterable, $properties): array\|iterable` | `Curry\findWhere`
[first](#first--head) / head | `first($iterable): mixed\|null` | `Curry\first`
[flatten](#flatten) | `flatten($iterable): array` | 
[flattenDeep](#flattendeep) | `flattenDeep($iterable): array\|iterable` | `Curry\flattenDeep`
[flattenDepth](#flattendepth) | `flattenDepth($iterable, $depth = 1): array\|iterable` | `Curry\flattenDepth`
[flip](#flip) | `flip(callable $callable): callable` | 
[get](#get) | `get($input, $path, $default = null): mixed` | `Curry\get`
[getDirect](#getdirect) | `getDirect($input, $key, $default = null): mixed` | `Curry\getDirect`
[getDirectRef](#getdirectref) | `getDirectRef(&$input, $key): mixed` | 
[groupBy](#groupby) | `groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array` | `Curry\groupBy`
[hasDirect](#hasdirect) | `hasDirect($input, $key): boolean` | `Curry\hasDirect`
[identical](#identical) | `identical($a, $b): boolean` | `Curry\identical`
[identity](#identity) | `identity($value): mixed` | `Curry\identity`
[ifElse](#ifelse) | `ifElse(callable $predicate, callable $onTrue, callable $onFalse): callable` | 
[indexOf](#indexof) | `indexOf($iterable, $value, $fromIndex = 0, $comparator = 'Dash\equal'): integer` | `Curry\indexOf`
[initial](#initial--init) / init | `initial($iterable): array\|iterable` | `Curry\initial`
[intersection](#intersection) | `intersection($iterable /*, ...iterables */): array` | 
[intersectionWith](#intersectionwith) | `intersectionWith($iterable, $other, $comparator = 'Dash\equal'): array` | `Curry\intersectionWith`
[invert](#invert--invertobj) / invertObj | `invert($iterable): array` | `Curry\invert`
[invertBy](#invertby) | `invertBy($iterable, $iteratee = 'Dash\identity'): array` | `Curry\invertBy`
[isEmpty](#isempty) | `isEmpty($value): boolean` | `Curry\isEmpty`
[isEven](#iseven) | `isEven($value): boolean` | `Curry\isEven`
[isIndexedArray](#isindexedarray) | `isIndexedArray($value): boolean` | `Curry\isIndexedArray`
[isOdd](#isodd) | `isOdd($value): boolean` | `Curry\isOdd`
[isType](#istype) | `isType($value, $type): boolean` | `Curry\isType`
[join](#join--implode) / implode | `join($iterable, $separator): string` | `Curry\join`
[juxt](#juxt--over) / over | `juxt($functions): callable` | 
[keyBy](#keyby--indexby) / indexBy | `keyBy($iterable, $iteratee = 'Dash\identity'): array` | `Curry\keyBy`
[keys](#keys) | `keys($iterable): array` | `Curry\keys`
[last](#last) | `last($iterable): mixed\|null` | `Curry\last`
[lastIndexOf](#lastindexof) | `lastIndexOf($iterable, $value, $fromIndex = null, $comparator = 'Dash\equal'): integer` | `Curry\lastIndexOf`
[map](#map) | `map($iterable, $iteratee = 'Dash\identity'): array` | `Curry\map`
[mapKeys](#mapkeys) | `mapKeys($iterable, $iteratee = 'Dash\identity'): array\|iterable` | `Curry\mapKeys`
[mapResult](#mapresult) | `mapResult($iterable, $path, $default = null): array` | `Curry\mapResult`
[mapValues](#mapvalues) | `mapValues($iterable, $iteratee = 'Dash\identity'): array` | `Curry\mapValues`
[matches](#matches) | `matches($properties): callable` | 
[matchesProperty](#matchesproperty) | `matchesProperty($path, $value = true, $comparator = 'Dash\equal'): function` | `Curry\matchesProperty`
[max](#max) | `max($iterable): mixed\|null` | `Curry\max`
[median](#median) | `median($iterable): mixed\|null` | `Curry\median`
[min](#min) | `min($iterable): mixed\|null` | `Curry\min`
[negate](#negate) | `negate(callable $predicate): callable` | `Curry\negate`
[nth](#nth) | `nth($iterable, $index, $default = null): mixed` | `Curry\nth`
[omit](#omit) | `omit($iterable, $keys): array` | `Curry\omit`
[omitBy](#omitby) | `omitBy($iterable, $predicate = 'Dash\identity'): array\|iterable` | `Curry\omitBy`
[once](#once) | `once(callable $callable): callable` | 
[pad](#pad) | `pad($iterable, $length, $padValue = null): array` | `Curry\pad`
[partial](#partial) | `partial($callable /*, ...args */): callable` | 
[partialRight](#partialright) | `partialRight($callable /*, ...args */): callable` | 
[partition](#partition) | `partition($iterable, $predicate = 'Dash\identity'): array` | `Curry\partition`
[pick](#pick) | `pick($iterable, $keys): array` | `Curry\pick`
[pickBy](#pickby) | `pickBy($iterable, $predicate = 'Dash\identity'): array\|iterable` | `Curry\pickBy`
[pipe](#pipe) | `pipe(callable ...$fns): callable` | 
[pluck](#pluck) | `pluck($iterable, $path, $default = null): array` | `Curry\pluck`
[property](#property) | `property($path, $default = null): function` | `Curry\property`
[range](#range) | `range($start, $end = null, $step = 1): array` | 
[reduce](#reduce) | `reduce($iterable, $iteratee, $initial = []): mixed` | `Curry\reduce`
[reduceRight](#reduceright) | `reduceRight($iterable, $iteratee, $initial = []): mixed` | `Curry\reduceRight`
[reject](#reject) | `reject($iterable, $predicate = 'Dash\identity'): array` | `Curry\reject`
[repeat](#repeat) | `repeat($value, $count): array` | `Curry\repeat`
[result](#result) | `result($input, $path, $default = null): mixed` | `Curry\result`
[reverse](#reverse) | `reverse($iterable, $preserveIntegerKeys = false): array` | `Curry\reverse`
[rotate](#rotate) | `rotate($iterable, $count = 1): array` | `Curry\rotate`
[scan](#scan) | `scan($iterable, $iteratee, $initial = []): array\|iterable` | `Curry\scan`
[set](#set) | `set(&$input, $path, $value): mixed` | 
[size](#size--count) / count | `size($value, $encoding = 'UTF-8'): integer` | `Curry\size`
[slice](#slice) | `slice($iterable, $offset = 0, $length = null): array\|iterable` | `Curry\slice`
[sort](#sort) | `sort($iterable, $comparator = 'Dash\compare'): array` | `Curry\sort`
[sortBy](#sortby) | `sortBy($iterable, $iteratee = 'Dash\identity'): array` | `Curry\sortBy`
[sortedIndex](#sortedindex) | `sortedIndex($iterable, $value, $comparator = 'Dash\compare'): integer` | `Curry\sortedIndex`
[sum](#sum) | `sum($iterable): numeric` | `Curry\sum`
[symmetricDifference](#symmetricdifference) | `symmetricDifference($iterable, $other): array` | `Curry\symmetricDifference`
[tail](#tail--rest) / rest | `tail($iterable): array\|iterable` | `Curry\tail`
[take](#take) | `take($iterable, $count = 1): array\|iterable` | `Curry\take`
[takeRight](#takeright) | `takeRight($iterable, $count = 1): array` | `Curry\takeRight`
[takeWhile](#takewhile) | `takeWhile($iterable, $predicate = 'Dash\identity'): array\|iterable` | `Curry\takeWhile`
[tap](#tap) | `tap($value, callable $interceptor): mixed` | `Curry\tap`
[thru](#thru) | `thru($value, callable $interceptor): mixed` | `Curry\thru`
[times](#times) | `times($n, $iteratee = 'Dash\identity'): array` | `Curry\times`
[toArray](#toarray) | `toArray($value): array` | `Curry\toArray`
[toObject](#toobject) | `toObject($value): object` | `Curry\toObject`
[toPairs](#topairs--pairs) / pairs | `toPairs($iterable): array` | `Curry\toPairs`
[unary](#unary) | `unary(callable $callable): callable` | `Curry\unary`
[union](#union) | `union($iterable /*, ...iterables */): array` | 
[unionWith](#unionwith) | `unionWith($iterable, $other, $comparator = 'Dash\equal'): array` | `Curry\unionWith`
[unique](#unique--distinct--uniq) / distinct / uniq | `unique($iterable): array` | 
[uniqueBy](#uniqueby--uniqby--distinctby) / uniqBy / distinctBy | `uniqueBy($iterable, $iteratee = 'Dash\identity'): array\|iterable` | `Curry\uniqueBy`
[unless](#unless) | `unless(callable $predicate, callable $onFalse): callable` | 
[unzip](#unzip--transpose) / transpose | `unzip($iterable): array` | `Curry\unzip`
[values](#values) | `values($iterable): array` | `Curry\values`
[when](#when) | `when(callable $predicate, callable $onTrue): callable` | 
[where](#where) | `where($iterable, $properties): array` | 
[without](#without) | `without($iterable, $exclude): array` | `Curry\without`
[zip](#zip) | `zip(/* ...$iterables */): array\|iterable` | 
[zipAll](#zipall) | `zipAll(/* ...$iterables */): array\|iterable` | 
[zipWith](#zipwith) | `zipWith($iterable1, $iterable2, callable $combiner): array\|iterable` | `Curry\zipWith`


all / every
---


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

allPass / overEvery
---


```php
allPass($predicates): callable
```
Creates a predicate that returns truthy only if every predicate in `$predicates` returns truthy.

Predicates are invoked with the same runtime arguments and evaluation short-circuits on the
first falsey result.


Parameter | Type | Description
--- | --- | :---
`$predicates` | `iterable\|stdClass\|null` |
**Returns** | `callable` |

**Example:**
```php
$fn = Dash\allPass([
	function ($n) { return $n > 0; },
	function ($n) { return $n % 2 === 0; },
]);
$fn(4);  // === true
$fn(3);  // === false
```

[↑ Top](#operations)

any / some
---


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

anyPass / overSome
---


```php
anyPass($predicates): callable
```
Creates a predicate that returns truthy if any predicate in `$predicates` returns truthy.

Predicates are invoked with the same runtime arguments and evaluation short-circuits on the
first truthy result.


Parameter | Type | Description
--- | --- | :---
`$predicates` | `iterable\|stdClass\|null` |
**Returns** | `callable` |

**Example:**
```php
$fn = Dash\anyPass([
	function ($n) { return $n < 0; },
	function ($n) { return $n % 2 === 0; },
]);
$fn(4);  // === true
$fn(3);  // === false
```

[↑ Top](#operations)

apply
---


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

assertType
---
See also: `isType()`

```php
assertType($value, $type, $funcName = __FUNCTION__): void

# Curried: (all parameters required)
Curry\assertType($type, $funcName, input)
```
Throws an `InvalidArgumentException` exception if `$value` is not of type `$type`.
If `$value` is an accepted type, this function is a no-op.


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

at
---


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

call
---


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

chain
---


```php
chain($input = null): Dash\Dash

# Curried: (all parameters required)
Curry\chain($input)
```
Creates a new chain. Alias for `Dash::chain()`.


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` | (optional) Initial input value of the chain
**Returns** | `Dash\Dash` | A new chain

**Example:**
```php
Dash\chain([1, 2, 3])
	->filter(function ($n) { return $n < 3; })
	->map(function ($n) { return $n * 2; })
	->value();
// === [2, 4]
```

[↑ Top](#operations)

chunk / splitEvery
---


```php
chunk($iterable, $size): array|iterable

# Curried: (all parameters required)
Curry\chunk($size, $iterable)
```
Splits `$iterable` into groups of `$size`.

The last group may contain fewer than `$size` elements.
Keys are preserved in each group unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$size` | `integer` |
**Returns** | `array\|iterable` | A list of groups from `$iterable`

**Example:**
```php
Dash\chunk([1, 2, 3, 4, 5], 2);
// === [[1, 2], [3, 4], [5]]

```

**Example:** With associative array
```php
Dash\chunk(['a' => 1, 'b' => 2, 'c' => 3], 2);
// === [['a' => 1, 'b' => 2], ['c' => 3]]
```

[↑ Top](#operations)

clamp
---


```php
clamp($number, $lower, $upper): numeric

# Curried: (all parameters required)
Curry\clamp($lower, $upper, $number)
```
Constrains `$number` to the inclusive range [`$lower`, `$upper`].


Parameter | Type | Description
--- | --- | :---
`$number` | `numeric` |
`$lower` | `numeric` |
`$upper` | `numeric` |
**Returns** | `numeric` |



[↑ Top](#operations)

compact
---


```php
compact($iterable): array|iterable

# Curried: (all parameters required)
Curry\compact($iterable)
```
Gets a list of truthy elements in `$iterable`.

This is equivalent to `filter($iterable, 'Dash\identity')`.
Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` | List of truthy elements in `$iterable`

**Example:**
```php
Dash\compact([0, 1, false, 2, '', 3, null]);
// === [1, 2, 3]

```

**Example:** With associative array
```php
Dash\compact(['a' => 0, 'b' => 2, 'c' => false, 'd' => 4]);
// === ['b' => 2, 'd' => 4]
```

[↑ Top](#operations)

compare
---


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

compose
---
See also: `pipe()`

```php
compose(callable ...$fns): callable
```
Returns a new function that performs right-to-left function composition.
For example, `compose(a, b, c)` will return a new function that performs `a(b(c()))`.

The last function can have any arity, but the rest must be unary.


Parameter | Type | Description
--- | --- | :---
`...$fns` | `callable` |
**Returns** | `callable` | New function that composes `$fns` right-to-left

**Example:**
```php
$addOne = function ($v) {
	return $v + 1;
};
$triple = function ($v) {
	return $v * 3;
};
$square = function ($v) {
	return $v * $v;
};

$composed = Dash\compose($square, $triple, $addOne);
$composed(1); // === 36

```

**Example:** Last function can accept multiple arguments
```php
$pow = function ($base, $exp) {
	return pow($base, $exp);
};
$addOne = function ($v) {
	return $v + 1;
};
$triple = function ($v) {
	return $v * 3;
};

$composed = Dash\compose($triple, $addOne, $pow);
$composed(2, 3); // === 27
```

[↑ Top](#operations)

cond
---


```php
cond($pairs): callable
```
Creates a function that dispatches to the first matching predicate/transform pair.

Each pair must be `[$predicate, $transform]`. Returned function evaluates predicates in order
and invokes the transform for the first truthy predicate. Returns `null` if no predicate matches.


Parameter | Type | Description
--- | --- | :---
`$pairs` | `iterable\|stdClass\|null` |
**Returns** | `callable` |

**Example:**
```php
$fn = Dash\cond([
	[function ($n) { return $n < 0; }, function () { return 'neg'; }],
	[function ($n) { return $n > 0; }, function () { return 'pos'; }],
]);
$fn(-1);  // === 'neg'
$fn(0);   // === null
```

[↑ Top](#operations)

contains / includes
---


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

converge
---


```php
converge(callable $combiner, $branches): callable
```
Creates a function that applies each branch function to the same runtime arguments, then passes
branch results as positional arguments to `$combiner`.


Parameter | Type | Description
--- | --- | :---
`$combiner` | `callable` |
`$branches` | `iterable\|stdClass\|null` |
**Returns** | `callable` |

**Example:**
```php
$avg = Dash\converge(function ($sum, $count) {
	return $sum / $count;
}, [
	'Dash\sum',
	'Dash\size',
]);
$avg([2, 4, 6]);  // === 4
```

[↑ Top](#operations)

countBy
---
See also: `groupBy()`, `keyBy()`

```php
countBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array

# Curried: (all parameters required)
Curry\countBy($iteratee, $defaultGroup, $iterable)
```
Counts elements of `$iterable` by key produced from `$iteratee`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string` | (optional) If a callable, invoked with `($value, $key, $iterable)`
`$defaultGroup` | `string` | (optional) The key used when `$iteratee` returns `null`
**Returns** | `array` | A new associative array of `[groupKey => count]`



[↑ Top](#operations)

currify
---
See also: `currifyN()`, `curry()`, `partial()`

```php
currify(callable $callable, array $args = [], $rotate = 1): function|mixed
```
Creates a new, curried version of `$callable` where the first `$rotate` arguments
are moved to the end of the arguments list.

In essence, this takes a data-first function and returns a curryable data-last function.


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
See also: `currify()`, `curry()`, `partial()`

```php
currifyN(callable $callable, $totalArgs, array $args = [], $rotate = 1): function|mixed
```
Creates a new, curried version of `$callable` where the first `$rotate` of `$totalArgs` arguments
are moved to the end of the arguments list.

In essence, this takes a data-first function and returns a curryable data-last function.


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
See also: `curryN()`, `curryRight()`, `partial()`, `currify()`

```php
curry(callable $callable /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.


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
See also: `curry()`

```php
curryN(callable $callable, $numRequiredArgs /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.


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
See also: `curry()`, `partial()`

```php
curryRight(callable $callable /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if its required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Like `partialRight()`, arguments are applied in reverse order.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.


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

$greetMary = Dash\curryRight($greet, 'Mary');
$greetMsMary = $greetMary('Ms.');
// === 'Good morning, Ms. Mary'

$greetPeter = Dash\curryRight($greet, 'Peter');
$greetSirPeter = $greetPeter('Sir');
// === 'Good morning, Sir Peter'

```

**Example:** With placeholders
```php
$greet = function ($greeting, $salutation, $name) {
	return "$greeting, $salutation $name";
};

$goodMorning = Dash\curryRight($greet, 'Good morning', Dash\_, Dash\_);
$goodMorningSir = $goodMorning('Sir', Dash\_);
// === 'Good morning, Sir Peter'

$greetMs = Dash\curryRight($greet, 'Ms.', Dash\_);
$goodMorningMs = $greetMs('Good morning', Dash\_);
// === 'Good morning, Ms. Mary'
```

[↑ Top](#operations)

curryRightN
---
See also: `curryN()`, `partialRight()`

```php
curryRightN(callable $callable, $numRequiredArgs /*, ...args */): function|mixed
```
Creates a new function that returns the result of `$callable` if the required number of parameters are supplied;
otherwise, it returns a function that accepts the remaining number of required parameters.

Like `partialRight()`, arguments are applied in reverse order.

Use `Dash\_` as a placeholder to replace with arguments from subsequent calls.


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

custom
---


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
Dash::setCustom('double', function ($n) { return $n * 2; });

$double = Dash\custom('double');
$double(3);
// === 6

Dash\chain([1, 2, 3])->map(Dash\custom('double'))->value();
// === [2, 4, 6]
```

[↑ Top](#operations)

debug
---


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

defaults
---


```php
defaults($input /*, ...$sources */): array
```
Fills missing or null keys in `$input` from sources, left to right.

The first non-null source value for a key wins.


Parameter | Type | Description
--- | --- | :---
`$input` | `iterable\|stdClass\|null` |
**Returns** | `array` |



[↑ Top](#operations)

deltas
---


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
See also: `intersection()`, `union()`

```php
difference($iterable /*, ...iterables */): array
```
Returns the set of elements from `$iterable` whose values are not present in any of the other iterables,
where values are compared using loose equality.

The order, keys, and values of elements in the returned array are determined by `$iterable`.


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

differenceWith
---
See also: `difference()`, `intersectionWith()`

```php
differenceWith($iterable, $other, $comparator = 'Dash\equal'): array

# Curried: (all parameters required)
Curry\differenceWith($other, $comparator, $iterable)
```
Returns values from `$iterable` that have no match in `$other`, using `$comparator` for equality (like `Dash\equal`).

Order and keys follow `$iterable`. Indexed inputs yield a reindexed array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$other` | `iterable\|stdClass\|null` |
`$comparator` | `callable` | (optional) Invoked as `($a, $b)`; truthy means values are considered equal
**Returns** | `array` |

**Example:**
```php
Dash\differenceWith(
	[['x' => 1], ['x' => 2], ['x' => 1]],
	[['x' => 2]],
	function ($a, $b) {
		return $a['x'] === $b['x'];
	}
);
// === [['x' => 1]]
```

[↑ Top](#operations)

dropWhile
---
See also: `takeWhile()`

```php
dropWhile($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\dropWhile($predicate, $iterable)
```
Returns a subset of `$iterable` that excludes elements from the beginning.

Elements are dropped while `$predicate` returns truthy, then all remaining elements are kept.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable` | (optional) Invoked with `($value, $key, $iterable)` for each element
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\dropWhile([2, 4, 6, 7, 8], 'Dash\isEven');
// === [7, 8]
```

[↑ Top](#operations)

each
---


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

equal
---


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

evolve
---


```php
evolve($input, array $transformations): array|object

# Curried: (all parameters required)
Curry\evolve($transformations, $input)
```
Returns a new copy of `$input` with transformations applied at matching top-level keys.

v1 applies only one level deep.


Parameter | Type | Description
--- | --- | :---
`$input` | `iterable\|stdClass\|null` |
`$transformations` | `array` |
**Returns** | `array\|object` |



[↑ Top](#operations)

filter
---
See also: `reject()`

```php
filter($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\filter($predicate, $iterable)
```
Gets a list of elements in `$iterable` for which `$predicate` returns truthy.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


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
See also: `findKey()`, `findValue()`, `findLast()`

```php
find($iterable, $predicate = 'Dash\identity'): array|null

# Curried: (all parameters required)
Curry\find($predicate, $iterable)
```
Gets the key and value of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.


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

findIndex
---
See also: `find()`, `findKey()`, `findLastIndex()`

```php
findIndex($iterable, $predicate = 'Dash\identity'): integer

# Curried: (all parameters required)
Curry\findIndex($predicate, $iterable)
```
Returns the 0-based index of the first element for which `$predicate` returns truthy, or `-1` if none.

Counts in forward iteration order (unrelated to numeric array keys for associative iterables).


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable\|string\|array` | (optional) Same forms as `find()`.
**Returns** | `integer` |

**Example:**
```php
Dash\findIndex([1, 2, 3, 4], 'Dash\isEven');
// === 1

Dash\findIndex(['a' => 1, 'b' => 2], function ($v) { return $v === 2; });
// === 1
```

[↑ Top](#operations)

findKey
---
See also: `find()`, `findValue()`, `findLastKey()`

```php
findKey($iterable, $predicate = 'Dash\identity'): string|null

# Curried: (all parameters required)
Curry\findKey($predicate, $iterable)
```
Gets the key of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.


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
See also: `findLastKey()`, `findLastValue()`, `find()`

```php
findLast($iterable, $predicate = 'Dash\identity'): array|null

# Curried: (all parameters required)
Curry\findLast($predicate, $iterable)
```
Gets the key and value of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.


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

findLastIndex
---
See also: `findLast()`, `findLastKey()`, `findIndex()`

```php
findLastIndex($iterable, $predicate = 'Dash\identity'): integer

# Curried: (all parameters required)
Curry\findLastIndex($predicate, $iterable)
```
Returns the 0-based index of the last element for which `$predicate` returns truthy, or `-1` if none.

Counts in forward iteration order (same indexing as `findIndex()`).


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable\|string\|array` | (optional) Same forms as `find()`.
**Returns** | `integer` |

**Example:**
```php
Dash\findLastIndex([1, 2, 3, 4, 2], function ($v) { return $v === 2; });
// === 4
```

[↑ Top](#operations)

findLastKey
---
See also: `findLast()`, `findLastValue()`, `findKey()`

```php
findLastKey($iterable, $predicate = 'Dash\identity'): string|null

# Curried: (all parameters required)
Curry\findLastKey($predicate, $iterable)
```
Gets the key of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.


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
See also: `findLast()`, `findLastKey()`, `findValue()`

```php
findLastValue($iterable, $predicate = 'Dash\identity'): mixed|null

# Curried: (all parameters required)
Curry\findLastValue($predicate, $iterable)
```
Gets the value of the last element for which `$predicate` returns truthy.

Iteration begin at the end and will stop at the last truthy return value.


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
See also: `find()`, `findKey()`, `findLastValue()`

```php
findValue($iterable, $predicate = 'Dash\identity'): mixed|null

# Curried: (all parameters required)
Curry\findValue($predicate, $iterable)
```
Gets the value of the first element for which `$predicate` returns truthy.

Iteration will stop at the first truthy return value.


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

findWhere
---
See also: `where()`, `matches()`, `filter()`

```php
findWhere($iterable, $properties): array|iterable

# Curried: (all parameters required)
Curry\findWhere($properties, $iterable)
```
Returns all elements of `$iterable` that match all key-value pairs in `$properties`.

Equivalent to `filter($iterable, matches($properties))`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$properties` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` |



[↑ Top](#operations)

first / head
---
See also: `take()`

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

flatten
---
See also: `groupBy()`

```php
flatten($iterable): array
```
Gets a list of nested elements in `$iterable`.

Keys in `$iterable` are not preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array` | List of elements in `$iterable`, including elements of directly nested iterables.

**Example:**
```php
Dash\flatten([[1, 2], [3, 4]]);
// === [1, 2, 3, 4]

Dash\flatten([['a' => 1, 'b' => 2], ['c' => 3]]);
// === [1, 2, 3]

```

**Example:** With a mix of nested and non-nested iterables
```php
Dash\flatten([1, 2, [3, 4]]);
// === [1, 2, 3, 4]

```

**Example:** Deeply nested array
```php
Dash\flatten([
	[1, 2],
	[[3, 4]]
]);
// === [1, 2, [3, 4]]
```

[↑ Top](#operations)

flattenDeep
---
See also: `flatten()`, `flattenDepth()`

```php
flattenDeep($iterable): array|iterable

# Curried: (all parameters required)
Curry\flattenDeep($iterable)
```
Recursively flattens nested arrays in `$iterable` into a single list (like repeated `flatten()` until no nested
arrays remain).

Non-array elements are left as-is. Keys are not preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\flattenDeep([[1, [2, [3, 4]]], 5]);
// === [1, 2, 3, 4, 5]
```

[↑ Top](#operations)

flattenDepth
---
See also: `flatten()`, `flattenDeep()`

```php
flattenDepth($iterable, $depth = 1): array|iterable

# Curried: (all parameters required)
Curry\flattenDepth($depth, $iterable)
```
Flattens nested arrays up to `$depth` levels (`1` behaves like `flatten()`).
A depth of `0` returns a copy of `$iterable` with the same indexed vs associative rules as other array-returning
operations.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$depth` | `integer` |
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\flattenDepth([[1, [2, [3]]]], 2);
// === [1, 2, [3]]

Dash\flattenDepth([[1, [2, [3]]]], 3);
// === [1, 2, 3]
```

[↑ Top](#operations)

flip
---


```php
flip(callable $callable): callable
```
Creates a new function that swaps the first two arguments before invoking `$callable`.

Any additional arguments are passed through unchanged.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` |
**Returns** | `callable` |

**Example:**
```php
$subtract = function ($a, $b) {
	return $a - $b;
};

$reverseSubtract = Dash\flip($subtract);
$reverseSubtract(2, 10);
// === 8
```

[↑ Top](#operations)

get
---
See also: `getDirect()`, `has()`, `property()`

```php
get($input, $path, $default = null): mixed

# Curried: (all parameters required)
Curry\get($path, $default, $input)
```
Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.


Parameter | Type | Description
--- | --- | :---
`$input` | `mixed` |
`$path` | `callable\|string\|integer` | If a callable, invoked with `($input)` to get the value at `$path`; if a string or integer, will use `Dash\property($path)` to get the value
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
See also: `getDirectRef()`, `hasDirect()`, `get()`

```php
getDirect($input, $key, $default = null): mixed

# Curried: (all parameters required)
Curry\getDirect($key, $default, $iterable)
```
Gets the array value, object property, or method at `$key` within `$input`.

If an array offset, object property, and/or method all exist for the same key,
the value at the array offset takes precedence and will be returned.


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
See also: `getDirect()`, `hasDirect()`

```php
getDirectRef(&$input, $key): mixed
```
Similar to `getDirect()`, but returns a reference to the value at `$key` within `$input`.


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

groupBy
---
See also: `keyBy()`

```php
groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null): array

# Curried: (all parameters required)
Curry\groupBy($iteratee, $defaultGroup, iterable)
```
Groups the element values of `$iterable` by the common return values of `$iteratee`.


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

hasDirect
---
See also: `getDirect()`

```php
hasDirect($input, $key): boolean

# Curried: (all parameters required)
Curry\hasDirect($key, $input)
```
Checks whether an array value, object property, or method exists at `$key` within `$input`.


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

ifElse
---


```php
ifElse(callable $predicate, callable $onTrue, callable $onFalse): callable
```
Creates a function that routes arguments to `$onTrue` or `$onFalse` based on `$predicate`.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` |
`$onTrue` | `callable` |
`$onFalse` | `callable` |
**Returns** | `callable` |

**Example:**
```php
$fn = Dash\ifElse(
	function ($n) { return $n >= 0; },
	function ($n) { return "pos:$n"; },
	function ($n) { return "neg:$n"; }
);
$fn(2);   // === 'pos:2'
$fn(-3);  // === 'neg:-3'
```

[↑ Top](#operations)

indexOf
---
See also: `contains()`, `lastIndexOf()`

```php
indexOf($iterable, $value, $fromIndex = 0, $comparator = 'Dash\equal'): integer

# Curried: (all parameters required)
Curry\indexOf($value, $fromIndex, $comparator, $iterable)
```
Returns the positional index of the first element equal to `$value`, or `-1` if not found.

Comparison is delegated to `$comparator($value, $current)`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$value` | `mixed` |
`$fromIndex` | `numeric` | (optional) Start index (negative offsets from the end)
`$comparator` | `callable` | (optional)
**Returns** | `integer` |



[↑ Top](#operations)

initial / init
---
See also: `last()`, `tail()`

```php
initial($iterable): array|iterable

# Curried: (all parameters required)
Curry\initial($iterable)
```
Returns all elements of `$iterable` except the last.

Keys are preserved unless `$iterable` is an indexed array. An empty or single-element iterable yields an empty array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\initial([1, 2, 3]);
// === [1, 2]

Dash\initial([1]);
// === []
```

[↑ Top](#operations)

intersection
---
See also: `difference()`, `union()`

```php
intersection($iterable /*, ...iterables */): array
```
Returns the set of elements from `$iterable` whose values are present in each of the other iterables,
where values are compared using loose equality.

The order, keys, and values of elements in the returned array are determined by `$iterable`.


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

intersectionWith
---
See also: `intersection()`, `differenceWith()`

```php
intersectionWith($iterable, $other, $comparator = 'Dash\equal'): array

# Curried: (all parameters required)
Curry\intersectionWith($other, $comparator, $iterable)
```
Returns values from `$iterable` that match some value in `$other`, using `$comparator` for equality
(like `Dash\equal`).

Order and keys follow `$iterable`. Indexed inputs yield a reindexed array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$other` | `iterable\|stdClass\|null` |
`$comparator` | `callable` | (optional) Invoked as `($a, $b)`; truthy means values are considered equal
**Returns** | `array` |

**Example:**
```php
Dash\intersectionWith(
	[['x' => 1], ['x' => 2]],
	[['x' => 2]],
	function ($a, $b) {
		return $a['x'] === $b['x'];
	}
);
// === [['x' => 2]]
```

[↑ Top](#operations)

invert / invertObj
---
See also: `keys()`, `values()`, `invertBy()`

```php
invert($iterable): array

# Curried: (all parameters required)
Curry\invert($iterable)
```
Returns a new associative array with keys and values swapped.

Later duplicate values overwrite earlier keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array` |



[↑ Top](#operations)

invertBy
---
See also: `invert()`, `mapKeys()`

```php
invertBy($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\invertBy($iteratee, $iterable)
```
Like `invert()`, but groups original keys into arrays by transformed value.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|integer` | (optional) Same forms as `mapValues()`
**Returns** | `array` |



[↑ Top](#operations)

isEmpty
---


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

isEven
---


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

isIndexedArray
---


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

isOdd
---


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

isType
---


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

join / implode
---


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

juxt / over
---


```php
juxt($functions): callable
```
Creates a function that applies each function in `$functions` to the same runtime arguments and
returns an array of results in order.


Parameter | Type | Description
--- | --- | :---
`$functions` | `iterable\|stdClass\|null` |
**Returns** | `callable` |

**Example:**
```php
$fn = Dash\juxt([
	function ($n) { return $n + 1; },
	function ($n) { return $n * 2; },
]);
$fn(3);  // === [4, 6]
```

[↑ Top](#operations)

keyBy / indexBy
---
See also: `groupBy()`

```php
keyBy($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\keyBy($iteratee, $iterable)
```
Gets the element values of `$iterable` as an associative array indexed by `$iteratee`.

A later value will overwrite an earlier value that has the same key.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|integer` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string or integer, will use `Dash\property($iteratee)` as the iteratee
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
See also: `values()`

```php
keys($iterable): array

# Curried: (all parameters required)
Curry\keys($iterable)
```
Gets the keys of `$iterable` as an array.


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
See also: `takeRight()`

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

lastIndexOf
---
See also: `indexOf()`, `contains()`

```php
lastIndexOf($iterable, $value, $fromIndex = null, $comparator = 'Dash\equal'): integer

# Curried: (all parameters required)
Curry\lastIndexOf($value, $fromIndex, $comparator, $iterable)
```
Returns the positional index of the last element equal to `$value`, or `-1` if not found.

Comparison is delegated to `$comparator($value, $current)`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$value` | `mixed` |
`$fromIndex` | `numeric\|null` | (optional) Last index to consider (negative offsets from the end)
`$comparator` | `callable` | (optional)
**Returns** | `integer` |



[↑ Top](#operations)

map
---
See also: `mapValues()`, `mapResult()`

```php
map($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\map($iteratee, $iterable)
```
Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.

Keys in `$iterable` are not preserved. To preserve keys, use `mapValues()` instead.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|number` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string, will use `Dash\property($iteratee)` as the iteratee
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

mapKeys
---
See also: `mapValues()`, `keyBy()`

```php
mapKeys($iterable, $iteratee = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\mapKeys($iteratee, $iterable)
```
Returns a new associative array with keys transformed by `$iteratee`, keeping original values.

Later key collisions overwrite earlier entries.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|integer` | (optional) Same forms as `mapValues()`
**Returns** | `array\|iterable` |



[↑ Top](#operations)

mapResult
---
See also: `map()`, `mapValues()`

```php
mapResult($iterable, $path, $default = null): array

# Curried: (all parameters required)
Curry\mapResult($path, $default, $iterable)
```
Invokes the callable located at `$path` within each element in `$iterable`,
and returns a new array of those callable return values.

Unlike `map()`, keys in `$iterable` are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$path` | `string` | Returns the result of `Dash\property($path, $default)` for each element
`$default` | `mixed` | (optional) Default value to return for an element if nothing exists at `$path`
**Returns** | `array` | A new array with the same keys as `$iterable`

**Example:**
```php
$data = [
	'john' => ['getHash' => function() { return md5('John Doe'); }],
	'jane' => ['getHash' => function() { return md5('Jane Doe'); }],
	'paul' => ['getHash' => function() { return md5('Paul Dyk'); }],
];
Dash\mapResult($data, 'getHash');
// === [
	'john' => '4c2a904bafba06591225113ad17b5cec',
	'jane' => '1c272047233576d77a9b9a1acfdf741c',
	'paul' => '022fbf2743848afb47158d9c80f28d03',
]
```

[↑ Top](#operations)

mapValues
---
See also: `map()`, `mapResult()`

```php
mapValues($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\mapValues($iteratee, $iterable)
```
Gets a new array of the return values of `$iteratee` when called with successive elements in `$iterable`.

Unlike `map()`, keys in `$iterable` are preserved.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|integer` | (optional) If a callable, invoked with `($value, $key, $iterable)` for each element in `$iterable`; if a string or integer, will use `Dash\property($iteratee)` as the iteratee
**Returns** | `array` | A new array with the same keys as `$iterable`

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

matches
---


```php
matches($properties): callable
```
Creates a predicate that checks whether an input contains all key-value pairs in `$properties`.

Uses loose equality for value comparison and supports nested paths via `get()`.


Parameter | Type | Description
--- | --- | :---
`$properties` | `iterable\|stdClass\|null` |
**Returns** | `callable` | with signature `($iterable): boolean`

**Example:**
```php
$matcher = Dash\matches(['b' => 2, 'd' => 4]);
$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);  // === true
$matcher(['a' => 1, 'b' => 2, 'c' => 3, 'e' => 5]);  // === false
```

[↑ Top](#operations)

matchesProperty
---


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

negate
---


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

nth
---
See also: `at()`, `first()`, `last()`

```php
nth($iterable, $index, $default = null): mixed

# Curried: (all parameters required)
Curry\nth($index, $default, $iterable)
```
Gets the `$n`th element of `$iterable` (by iteration order, ignoring keys).
Negative `$n` counts from the end (`-1` is the last element).


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$index` | `integer` |
`$default` | `mixed` | (optional) Returned when the index is out of bounds
**Returns** | `mixed` |

**Example:**
```php
Dash\nth([10, 20, 30], 1);
// === 20

Dash\nth([10, 20, 30], -1);
// === 30
```

[↑ Top](#operations)

omit
---
See also: `pick()`

```php
omit($iterable, $keys): array

# Curried: (all parameters required)
Curry\omit($keys, $iterable)
```
Gets the elements of `$iterable` with keys that match any in `$keys`.
The opposite of `pick()`.


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

omitBy
---
See also: `pickBy()`, `filter()`

```php
omitBy($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\omitBy($predicate, $iterable)
```
Omits elements of `$iterable` for which `$predicate` returns truthy, preserving keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable\|string\|array` | (optional) Same forms as `filter()`
**Returns** | `array\|iterable` |



[↑ Top](#operations)

once
---


```php
once(callable $callable): callable
```
Creates a new function that invokes `$callable` at most once.

Subsequent calls return the result from the first invocation.


Parameter | Type | Description
--- | --- | :---
`$callable` | `callable` |
**Returns** | `callable` |

**Example:**
```php
$next = 0;
$inc = Dash\once(function () use (&$next) {
	$next++;
	return $next;
});

$inc();  // === 1
$inc();  // === 1
```

[↑ Top](#operations)

pad
---


```php
pad($iterable, $length, $padValue = null): array

# Curried: (all parameters required)
Curry\pad($length, $padValue, $iterable)
```
Pads `$iterable` to `$length` by adding `$padValue` to both sides.

If total padding is odd, the extra element is added to the right side.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$length` | `integer` |
`$padValue` | `mixed` | (optional)
**Returns** | `array` |



[↑ Top](#operations)

partial
---
See also: `partialRight()`, `curry()`

```php
partial($callable /*, ...args */): callable
```
Creates a new function that will invoke `$callable` with the given arguments
and any others passed to the returned function.

When calling `$callable`, arguments provided to `partial()` will be listed
BEFORE those passed to the returned function.

Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.


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
See also: `partial()`, `curryRight()`

```php
partialRight($callable /*, ...args */): callable
```
Creates a new function that will invoke `$callable` with the given arguments
and any others passed to the returned function.

When calling `$callable`, arguments provided to `partial()` will be listed
AFTER those passed to the returned function.

Use `Dash\_` as a placeholder to replace with arguments passed to the returned function.


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

partition
---
See also: `filter()`, `reject()`

```php
partition($iterable, $predicate = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\partition($predicate, $iterable)
```
Splits `$iterable` into two lists: elements for which `$predicate` returns truthy, and the rest.

Keys are preserved in each list unless `$iterable` is an indexed array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable\|string\|array` | (optional) Same forms as `filter()`: callable `($value, $key, $iterable)`, string path for `matchesProperty`, or `[$field, $value]`.
**Returns** | `array` | A two-element array: `[ $passing, $failing ]`, each an array

**Example:**
```php
Dash\partition([1, 2, 3, 4], 'Dash\isEven');
// === [[2, 4], [1, 3]]

```

**Example:** With associative array
```php
Dash\partition(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], 'Dash\isEven');
// === [['b' => 2, 'd' => 4], ['a' => 1, 'c' => 3]]
```

[↑ Top](#operations)

pick
---
See also: `omit()`

```php
pick($iterable, $keys): array

# Curried: (all parameters required)
Curry\pick($keys, $iterable)
```
Gets the elements of `$iterable` with keys that match any in `$keys`.


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

pickBy
---
See also: `filter()`, `omitBy()`

```php
pickBy($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\pickBy($predicate, $iterable)
```
Picks elements of `$iterable` for which `$predicate` returns truthy, always preserving keys.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable\|string\|array` | (optional) Same forms as `filter()`
**Returns** | `array\|iterable` |



[↑ Top](#operations)

pipe
---
See also: `compose()`

```php
pipe(callable ...$fns): callable
```
Returns a new function that performs left-to-right function composition.
For example, `pipe(a, b, c)` will return a new function that performs `c(b(a()))`.

The first function can have any arity, but the rest must be unary.


Parameter | Type | Description
--- | --- | :---
`...$fns` | `callable` |
**Returns** | `callable` | New function that composes `$fns` left-to-right

**Example:**
```php
$addOne = function ($v) {
	return $v + 1;
};
$triple = function ($v) {
	return $v * 3;
};
$square = function ($v) {
	return $v * $v;
};

$piped = Dash\pipe($addOne, $triple, $square);
$piped(1); // === 36

```

**Example:** First function can accept multiple arguments
```php
$pow = function ($base, $exp) {
	return pow($base, $exp);
};
$addOne = function ($v) {
	return $v + 1;
};
$triple = function ($v) {
	return $v * 3;
};

$piped = Dash\pipe($pow, $addOne, $triple);
$piped(2, 3); // === 27
```

[↑ Top](#operations)

pluck
---
See also: `map()`

```php
pluck($iterable, $path, $default = null): array

# Curried: (all parameters required)
Curry\pluck($path, $default, $iterable)
```
Gets an array of values at `$path` for all elements in `$iterable`.


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

range
---


```php
range($start, $end = null, $step = 1): array
```
Returns an array of numbers from `$start` (inclusive) to `$end` (exclusive), stepping by `$step`.

With one argument, range is `[0, $start)`.


Parameter | Type | Description
--- | --- | :---
`$start` | `numeric` |
`$end` | `numeric\|null` | (optional)
`$step` | `numeric` | (optional)
**Returns** | `array` |



[↑ Top](#operations)

reduce
---


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

reduceRight
---
See also: `reduce()`, `reverse()`

```php
reduceRight($iterable, $iteratee, $initial = []): mixed

# Curried: (all parameters required)
Curry\reduceRight($iteratee, $initial, $iterable)
```
Iteratively reduces `$iterable` from right to left by way of `$iteratee`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable` | Called with `($result, $value, $key)` for each element from right to left
`$initial` | `mixed` | (optional) Initial value
**Returns** | `mixed` |



[↑ Top](#operations)

reject
---
See also: `filter()`

```php
reject($iterable, $predicate = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\reject($predicate, $iterable)
```
Gets a list of elements in `$iterable` for which `$predicate` returns falsey.
The opposite of `filter()`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


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

repeat
---


```php
repeat($value, $count): array

# Curried: (all parameters required)
Curry\repeat($count, $value)
```
Returns an array of length `$count` with every element set to `$value`.


Parameter | Type | Description
--- | --- | :---
`$value` | `mixed` |
`$count` | `numeric` |
**Returns** | `array` |



[↑ Top](#operations)

result
---
See also: `get()`, `property()`

```php
result($input, $path, $default = null): mixed

# Curried: (all parameters required)
Curry\result($path, $default, $input)
```
Gets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
Like `get()` but if the value is callable, it is invoked and its return value is returned.


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

reverse
---


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

scan
---
See also: `reduce()`

```php
scan($iterable, $iteratee, $initial = []): array|iterable

# Curried: (all parameters required)
Curry\scan($iteratee, $initial, $iterable)
```
Like `reduce()`, but returns all intermediate accumulator values from left to right.

Output begins with `$initial`, then one accumulator value per element.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable` | Called with `($result, $value, $key)` for each element
`$initial` | `mixed` | (optional) Initial value
**Returns** | `array\|iterable` |



[↑ Top](#operations)

set
---
See also: `get()`, `getDirect()`, `property()`

```php
set(&$input, $path, $value): mixed
```
Sets the value at `$path` within `$input`. Nested properties are accessible with dot notation.
Note: This *will* modify `$input`.


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

slice
---


```php
slice($iterable, $offset = 0, $length = null): array|iterable

# Curried: (all parameters required)
Curry\slice($offset, $length, $iterable)
```
Returns a segment of `$iterable` from `$offset` with optional `$length`.

Keys are preserved unless `$iterable` is an indexed array.

For generators, only non-negative `$offset` and non-negative (or null) `$length` are supported.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$offset` | `integer` |
`$length` | `integer\|null` |
**Returns** | `array\|iterable` |



[↑ Top](#operations)

sort
---


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

sortBy
---
See also: `sort()`, `groupBy()`

```php
sortBy($iterable, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\sortBy($iteratee, $iterable)
```
Sorts `$iterable` by the values produced by `$iteratee` for each element (stable tie-breaking).

Keys are preserved unless `$iterable` is an indexed array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|array\|int` | (optional) Same resolution as `groupBy()` for each element value.
**Returns** | `array` |

**Example:**
```php
Dash\sortBy([['a' => 2], ['a' => 1], ['a' => 3]], 'a');
// === [['a' => 1], ['a' => 2], ['a' => 3]]

Dash\sortBy([4, 3, 5, 1, 2], 'Dash\identity');
// === [1, 2, 3, 4, 5]
```

[↑ Top](#operations)

sortedIndex
---


```php
sortedIndex($iterable, $value, $comparator = 'Dash\compare'): integer

# Curried: (all parameters required)
Curry\sortedIndex($value, $comparator, $iterable)
```
Returns the insertion index for `$value` in an already-sorted `$iterable`.

Uses `$comparator($left, $right)` with `Dash\compare` semantics.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$value` | `mixed` |
`$comparator` | `callable` | (optional)
**Returns** | `integer` |



[↑ Top](#operations)

sum
---


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

symmetricDifference
---
See also: `difference()`, `union()`

```php
symmetricDifference($iterable, $other): array

# Curried: (all parameters required)
Curry\symmetricDifference($other, $iterable)
```
Returns values present in either `$iterable` or `$other`, but not both.

Result order is `$iterable`-only values first, then `$other`-only values.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$other` | `iterable\|stdClass\|null` |
**Returns** | `array` |

**Example:**
```php
Dash\symmetricDifference([1, 2, 3], [2, 4]);
// === [1, 3, 4]
```

[↑ Top](#operations)

tail / rest
---
See also: `first()`, `initial()`

```php
tail($iterable): array|iterable

# Curried: (all parameters required)
Curry\tail($iterable)
```
Returns all elements of `$iterable` except the first.

Keys are preserved unless `$iterable` is an indexed array. An empty iterable yields an empty array.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\tail([1, 2, 3]);
// === [2, 3]

Dash\tail([1]);
// === []
```

[↑ Top](#operations)

take
---
See also: `takeRight()`

```php
take($iterable, $count = 1): array|iterable

# Curried: (all parameters required)
Curry\take($count, $iterable)
```
Gets a new array of the first `$count` elements of `$iterable`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


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
See also: `take()`

```php
takeRight($iterable, $count = 1): array

# Curried: (all parameters required)
Curry\takeRight($count, $iterable)
```
Gets a new array of the last `$count` elements of `$iterable`.

Keys are preserved unless `$iterable` is an indexed array.
An indexed array is one with sequential integer keys starting at zero. See [isIndexedArray()](#isindexedarray)


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

takeWhile
---
See also: `dropWhile()`

```php
takeWhile($iterable, $predicate = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\takeWhile($predicate, $iterable)
```
Returns a subset of `$iterable` taken from the beginning while `$predicate` returns truthy.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$predicate` | `callable` | (optional) Invoked with `($value, $key, $iterable)`
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\takeWhile([2, 4, 6, 7, 8, 10], 'Dash\isEven');
// === [2, 4, 6]
```

[↑ Top](#operations)

tap
---


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
$result = Dash\chain([1, 3, 4])
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
$result = Dash\chain([1, 3, 4])
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

times
---


```php
times($n, $iteratee = 'Dash\identity'): array

# Curried: (all parameters required)
Curry\times($iteratee, $n)
```
Calls `$iteratee` `$n` times with each 0-based index and returns collected results.


Parameter | Type | Description
--- | --- | :---
`$n` | `numeric` |
`$iteratee` | `callable` | (optional)
**Returns** | `array` |



[↑ Top](#operations)

toArray
---


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

toPairs / pairs
---
See also: `values()`, `keys()`

```php
toPairs($iterable): array

# Curried: (all parameters required)
Curry\toPairs($iterable)
```
Converts `$iterable` to a list of `[key, value]` tuples.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array` |



[↑ Top](#operations)

unary
---


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

union
---
See also: `intersection()`, `difference()`

```php
union($iterable /*, ...iterables */): array
```
Returns a new array containing the combined set of unique values, in order, of all provided iterables.

Non-indexed keys are preseved, but duplicate keys will overwrite previous ones.


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

unionWith
---
See also: `union()`, `intersectionWith()`

```php
unionWith($iterable, $other, $comparator = 'Dash\equal'): array

# Curried: (all parameters required)
Curry\unionWith($other, $comparator, $iterable)
```
Returns the combined values of `$iterable` and `$other`, in that order, omitting later values that compare equal
to an earlier one using `$comparator`.

When `$iterable` is indexed, new values are appended and the result is reindexed.
Otherwise keys from `$other` are used for appended entries.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$other` | `iterable\|stdClass\|null` |
`$comparator` | `callable` | (optional) Invoked as `($a, $b)`; truthy means values are considered equal
**Returns** | `array` |

**Example:**
```php
Dash\unionWith([1, 3], [2, 1], 'Dash\equal');
// === [1, 3, 2]
```

[↑ Top](#operations)

unique / distinct / uniq
---


```php
unique($iterable): array
```
Returns a new array containing the unique values, in order, of the provided iterable.

Non-indexed keys are preseved, but duplicate keys will overwrite previous ones.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
**Returns** | `array` |

**Example:** With indexed arrays
```php
Dash\unique([1, 2, 2, 3, 1]);
// === [1, 2, 3]

```

**Example:** With associative arrays
```php
Dash\unique(['a' => 1, 'b' => 2, 'c' => 1]);
// === ['a' => 1, 'b' => 2]
```

[↑ Top](#operations)

uniqueBy / uniqBy / distinctBy
---
See also: `unique()`, `keyBy()`, `groupBy()`

```php
uniqueBy($iterable, $iteratee = 'Dash\identity'): array|iterable

# Curried: (all parameters required)
Curry\uniqueBy($iteratee, $iterable)
```
Returns a new list of unique values, where uniqueness is determined by the return value of `$iteratee`
for each element.

The first occurrence of each computed key is kept. Keys are preserved unless `$iterable` is an indexed array.
If `$iterable` is a `Generator`, a lazy `Generator` is returned.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$iteratee` | `callable\|string\|array\|int` | (optional) Same resolution as `groupBy()`: path on each value, or callable `($value, $key, $iterable)`.
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\uniqueBy([1, 2, 1, 3, 2], 'Dash\identity');
// === [1, 2, 3]

```

**Example:** With a path iteratee
```php
$rows = [
	['id' => 1, 'name' => 'a'],
	['id' => 1, 'name' => 'b'],
	['id' => 2, 'name' => 'c'],
];
Dash\uniqueBy($rows, 'id');
// === [['id' => 1, 'name' => 'a'], ['id' => 2, 'name' => 'c']]
```

[↑ Top](#operations)

unless
---
See also: `ifElse()`, `when()`

```php
unless(callable $predicate, callable $onFalse): callable
```
Creates a function that applies `$onFalse` when `$predicate` returns falsey; otherwise returns
the first argument unchanged.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` |
`$onFalse` | `callable` |
**Returns** | `callable` |



[↑ Top](#operations)

unzip / transpose
---


```php
unzip($iterable): array

# Curried: (all parameters required)
Curry\unzip($iterable)
```
Inverse of `zip()`: turns an iterable of tuples into parallel arrays (columns).


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` | Iterable of rows (each row an iterable of cells)
**Returns** | `array` | A list of arrays; each inner array is one column across rows.

**Example:**
```php
Dash\unzip([[1, 10], [2, 20], [3, 30]]);
// === [[1, 2, 3], [10, 20, 30]]
```

[↑ Top](#operations)

values
---
See also: `keys()`

```php
values($iterable): array

# Curried: (all parameters required)
Curry\values($iterable)
```
Gets the values of `$iterable` as an array.


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

when
---
See also: `ifElse()`, `unless()`

```php
when(callable $predicate, callable $onTrue): callable
```
Creates a function that applies `$onTrue` when `$predicate` returns truthy; otherwise returns
the first argument unchanged.


Parameter | Type | Description
--- | --- | :---
`$predicate` | `callable` |
`$onTrue` | `callable` |
**Returns** | `callable` |



[↑ Top](#operations)

where
---
See also: `matches()`, `filter()`

```php
where($iterable, $properties): array
```
Returns all elements of `$iterable` containing key-value pairs that loosely equal `$properties`.


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$properties` | `iterable\|stdClass\|null` |
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
Dash\where($input, ['gender' => 'f', 'age' => 30]);
// === [
	['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
	['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
]
```

[↑ Top](#operations)

without
---
See also: `reject()`, `contains()`

```php
without($iterable, $exclude): array

# Curried: (all parameters required)
Curry\without($exclude, $iterable)
```
Returns a new array of `$iterable` excluding all values in `$exclude` (loose equality).


Parameter | Type | Description
--- | --- | :---
`$iterable` | `iterable\|stdClass\|null` |
`$exclude` | `iterable\|stdClass\|null` | Values to exclude
**Returns** | `array` | Subset of $iterable

**Example:**
```php
Dash\without(['a', 'b', 'c', 'd'], ['b', 'c']);
// === ['a', 'd']
```

[↑ Top](#operations)

zip
---


```php
zip(/* ...$iterables */): array|iterable
```
Combines parallel iterables into tuples (arrays of values), one tuple per index position.

The length of the result is the length of the shortest iterable (truncated).


Parameter | Type | Description
--- | --- | :---
`...$iterables` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` | A list of tuples; each tuple's elements are drawn from each iterable at the same logical

**Example:**
```php
Dash\zip([1, 2, 3], [10, 20, 30]);
// === [[1, 10], [2, 20], [3, 30]]

Dash\zip([1, 2], [10, 20, 99]);
// === [[1, 10], [2, 20]]

```

**Example:** With no arguments
```php
Dash\zip();
// === []
```

[↑ Top](#operations)

zipAll
---


```php
zipAll(/* ...$iterables */): array|iterable
```
Like `zip()`, but uses the longest iterable length and pads missing positions with `null`.


Parameter | Type | Description
--- | --- | :---
`...$iterables` | `iterable\|stdClass\|null` |
**Returns** | `array\|iterable` | A list of tuples

**Example:**
```php
Dash\zipAll([1, 2], [10]);
// === [[1, 10], [2, null]]
```

[↑ Top](#operations)

zipWith
---


```php
zipWith($iterable1, $iterable2, callable $combiner): array|iterable

# Curried: (all parameters required)
Curry\zipWith($combiner, $iterable1, $iterable2)
```
Combines two iterables element-wise using `$combiner($valueFromFirst, $valueFromSecond)`.

Stops when the shorter iterable ends (same length rule as `zip()`).


Parameter | Type | Description
--- | --- | :---
`$iterable1` | `iterable\|stdClass\|null` |
`$iterable2` | `iterable\|stdClass\|null` |
`$combiner` | `callable` | Invoked with `($valueFromFirst, $valueFromSecond)` for each aligned pair
**Returns** | `array\|iterable` |

**Example:**
```php
Dash\zipWith([1, 2, 3], [10, 20, 30], function ($a, $b) {
	return $a + $b;
});
// === [11, 22, 33]
```

[↑ Top](#operations)