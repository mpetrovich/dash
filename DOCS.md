Table of contents
===
### Iterable
- [all](#all)
- [each](#each)
- [get](#get)
- [map](#map)
- [mapValues](#mapvalues)
- [pluck](#pluck)
- [property](#property)

### Other
- [any](#any)
- [ary](#ary)
- [assertType](#asserttype)
- [at](#at)
- [average](#average)
- [chain](#chain)
- [compare](#compare)
- [contains](#contains)
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

### Iterables
- [filter](#filter)


Iterable
===

all
---
```php
all($input, $predicate)
```
Checks whether $predicate returns truthy for every item in $input.


Name | Type | Description
--- | --- | ---
`$input` | `mixed` | Any iterable
`$predicate` | `callable` | A callable invoked with ($value, $key) that returns a boolean


**Example:** 
```php
all([1, 2, 3], function($n) { return $n < 3; });  // === false
all([1, 2, 3], function($n) { return $n < 4; });  // === true

all([1, 2, 3], 'Dash\isOdd');  // === false
all([1, 3, 5], 'Dash\isOdd');  // === true
```
each
---
```php
each($iterable, $iteratee)
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
	array(1, 2, 3),
	function($n) { echo $n; }
);  // Prints "123"
```
get
---
```php
get($iterable, $path, $default)
```
Gets the value at a path on a collection.


Name | Type | Description
--- | --- | ---
`$iterable` | `array\|object` | 
`$path` | `string` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period
`$default` | `mixed` | Default value to return if nothing exists at $path 


**Example:** 
```php
$iterable = array(
	'a' => array(
		'b' => 'value'
	)
);
Dash\get($iterable, 'a.b') == 'value';

```

**Example:** Array elements can be referenced by index
```php
$iterable = array(
	'people' => array(
		array('name' => 'Pete'),
		array('name' => 'John'),
		array('name' => 'Paul'),
	)
);
Dash\get($iterable, 'people.1.name') == 'John';

```

**Example:** Keys with the same name as the full path can be used
```php
$iterable = array('a.b.c' => 'value');
Dash\get($iterable, 'a.b.c') == 'value';
```
map
---
```php
map($iterable, $iteratee)
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
	array(1, 2, 3),
	function($n) {
		return $n * 2;
	}
) == array(2, 4, 6);

```

**Example:** 
```php
Dash\map(
	array('roses' => 'red', 'violets' => 'blue'),
	function($color, $flower) {
		return $flower . ' are ' . $color;
	}
) == array('roses are red', 'violets are blue');

```

**Example:** With $iteratee as a path
```php
Dash\map(
	array('color' => 'red', 'color' => 'blue'),
	'color'
) == array('red', 'blue');
```
mapValues
---
```php
mapValues($iterable, $iteratee)
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
	array(1, 2, 3),
	function($n) { return $n * 2; }
) == array(2, 4, 6);

```

**Example:** 
```php
Dash\map(
	array('roses' => 'red', 'violets' => 'blue'),
	function($color, $flower) { return $flower . ' are ' . $color; }
) == array('roses' => 'roses are red', 'violets' => 'violets are blue');
```
pluck
---
```php
pluck($iterable, $path, $default)
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
	array(
		array('a' => array('b' => 1)),
		array('a' => 'missing'),
		array('a' => array('b' => 3)),
		array('a' => array('b' => 4)),
	),
	'a.b',
	'default'
) == array(1, 'default', 3, 4);
```
property
---
```php
property($path, $default)
```
Creates a function that returns the value at a path on a collection.


Name | Type | Description
--- | --- | ---
`$path` | `string\|function` | Path of the property to retrieve; can be nested by delimiting each sub-property or array index with a period. If it is a function, the same function is returned.
`$default` | `mixed` | Default value to return if nothing exists at $path


**Example:** 
```php
$getter = Dash\property('a.b');
$iterable = array(
	'a' => array(
		'b' => 'value'
	)
);
$getter($iterable) == 'value';

```

**Example:** Array elements can be referenced by index
```php
$getter = Dash\property('people.1.name');
$iterable = array(
	'people' => array(
		array('name' => 'Pete'),
		array('name' => 'John'),
		array('name' => 'Paul'),
	)
);
$getter($iterable) == 'John';

```

**Example:** Keys with the same name as the full path can be used
```php
$getter = Dash\property('a.b.c');
$iterable = array('a.b.c' => 'value');
$getter($iterable) == 'value';
```

Other
===

any
---
```php
any()
```


Name | Type | Description
--- | --- | ---



ary
---
```php
ary()
```


Name | Type | Description
--- | --- | ---



assertType
---
```php
assertType()
```


Name | Type | Description
--- | --- | ---



at
---
```php
at()
```


Name | Type | Description
--- | --- | ---



average
---
```php
average()
```


Name | Type | Description
--- | --- | ---



chain
---
```php
chain()
```


Name | Type | Description
--- | --- | ---



compare
---
```php
compare()
```


Name | Type | Description
--- | --- | ---



contains
---
```php
contains()
```


Name | Type | Description
--- | --- | ---



deltas
---
```php
deltas()
```


Name | Type | Description
--- | --- | ---



difference
---
```php
difference()
```


Name | Type | Description
--- | --- | ---



display
---
```php
display()
```


Name | Type | Description
--- | --- | ---



dropWhile
---
```php
dropWhile()
```


Name | Type | Description
--- | --- | ---



equal
---
```php
equal()
```


Name | Type | Description
--- | --- | ---



every
---
```php
every()
```


Name | Type | Description
--- | --- | ---



find
---
```php
find()
```


Name | Type | Description
--- | --- | ---



findKey
---
```php
findKey()
```


Name | Type | Description
--- | --- | ---



findLast
---
```php
findLast()
```


Name | Type | Description
--- | --- | ---



findValue
---
```php
findValue()
```


Name | Type | Description
--- | --- | ---



first
---
```php
first()
```


Name | Type | Description
--- | --- | ---



getDirect
---
```php
getDirect()
```


Name | Type | Description
--- | --- | ---



getDirectRef
---
```php
getDirectRef()
```


Name | Type | Description
--- | --- | ---



groupBy
---
```php
groupBy()
```


Name | Type | Description
--- | --- | ---



hasDirect
---
```php
hasDirect()
```


Name | Type | Description
--- | --- | ---



identical
---
```php
identical()
```


Name | Type | Description
--- | --- | ---



identity
---
```php
identity()
```


Name | Type | Description
--- | --- | ---



indexBy
---
```php
indexBy()
```


Name | Type | Description
--- | --- | ---



intersection
---
```php
intersection()
```


Name | Type | Description
--- | --- | ---



is
---
```php
is()
```


Name | Type | Description
--- | --- | ---



isEmpty
---
```php
isEmpty()
```


Name | Type | Description
--- | --- | ---



isEven
---
```php
isEven()
```


Name | Type | Description
--- | --- | ---



isOdd
---
```php
isOdd()
```


Name | Type | Description
--- | --- | ---



join
---
```php
join()
```


Name | Type | Description
--- | --- | ---



keyBy
---
```php
keyBy()
```


Name | Type | Description
--- | --- | ---



keys
---
```php
keys()
```


Name | Type | Description
--- | --- | ---



last
---
```php
last()
```


Name | Type | Description
--- | --- | ---



matches
---
```php
matches()
```


Name | Type | Description
--- | --- | ---



matchesProperty
---
```php
matchesProperty()
```


Name | Type | Description
--- | --- | ---



max
---
```php
max()
```


Name | Type | Description
--- | --- | ---



median
---
```php
median()
```


Name | Type | Description
--- | --- | ---



min
---
```php
min()
```


Name | Type | Description
--- | --- | ---



negate
---
```php
negate()
```


Name | Type | Description
--- | --- | ---



partial
---
```php
partial()
```


Name | Type | Description
--- | --- | ---



partialRight
---
```php
partialRight()
```


Name | Type | Description
--- | --- | ---



pick
---
```php
pick()
```


Name | Type | Description
--- | --- | ---



reduce
---
```php
reduce()
```


Name | Type | Description
--- | --- | ---



reject
---
```php
reject()
```


Name | Type | Description
--- | --- | ---



reverse
---
```php
reverse()
```


Name | Type | Description
--- | --- | ---



set
---
```php
set()
```


Name | Type | Description
--- | --- | ---



size
---
```php
size()
```


Name | Type | Description
--- | --- | ---



sort
---
```php
sort()
```


Name | Type | Description
--- | --- | ---



sum
---
```php
sum()
```


Name | Type | Description
--- | --- | ---



take
---
```php
take()
```


Name | Type | Description
--- | --- | ---



takeRight
---
```php
takeRight()
```


Name | Type | Description
--- | --- | ---



takeWhile
---
```php
takeWhile()
```


Name | Type | Description
--- | --- | ---



tap
---
```php
tap()
```


Name | Type | Description
--- | --- | ---



thru
---
```php
thru()
```


Name | Type | Description
--- | --- | ---



toArray
---
```php
toArray()
```


Name | Type | Description
--- | --- | ---



union
---
```php
union()
```


Name | Type | Description
--- | --- | ---



values
---
```php
values()
```


Name | Type | Description
--- | --- | ---



where
---
```php
where()
```


Name | Type | Description
--- | --- | ---



without
---
```php
without()
```


Name | Type | Description
--- | --- | ---




Iterables
===

filter
---
```php
filter($iterable, $predicate)
```
Returns a subset of $iterable for which $predicate is truthy.
Keys and key order are preserved.


Name | Type | Description
--- | --- | ---
`$iterable` | `iterable` | 
`$predicate` | `callable` | Callable invoked with ($value, $key) for each item in $iterable



