Collection
===

all
---
```php
all($input, $predicate)
```
Checks whether $predicate returns truthy for every item in $input.
$predicate will be called with ($value, $key).

Name | Type | Description
--- | --- | ---
`$input` | `mixed` | Any iterable
`$predicate` | `callable` | 

each
---
```php
each($collection, $iteratee)
```
Iterates over a collection and calls an iteratee function for each element.
Any changes to the value, key, or collection from within the iteratee
function are not persisted. If the original collection needs to be mutated,
use a native `foreach` loop instead.

Name | Type | Description
--- | --- | ---
`$collection` | `array\|object` | 
`$iteratee` | `Callable` | Function called with (element, key, collection)

get
---
```php
get($collection, $path, $default)
```
Gets the value at a path on a collection.

Name | Type | Description
--- | --- | ---
`$collection` | `array\|object` | 
`$path` | `string` | Path of the property to retrieve; can be nested by
`$default` | `mixed` | Default value to return if nothing exists at $path

map
---
```php
map($collection, $iteratee)
```
Creates a new indexed array of values by running each element in a
collection through an iteratee function.
Keys in the original collection are _not_ preserved; a freshly indexed array
is returned.

Name | Type | Description
--- | --- | ---
`$collection` | `array\|object` | 
`$iteratee` | `Callable\|string` | Function called with (element, key, collection)

mapValues
---
```php
mapValues($collection, $iteratee)
```
Creates a new array of values by running each element in a collection
through an iteratee function.
Keys in the original collection _are_ preserved.

Name | Type | Description
--- | --- | ---
`$collection` | `array\|object` | 
`$iteratee` | `Callable` | Function called with (element, key, collection)

pluck
---
```php
pluck($collection, $path)
```
Gets the value at a path for all elements in a collection.

Name | Type | Description
--- | --- | ---
`$collection` | `array\|object` | 
`$path` | `string` | Path of the property to retrieve; can be nested by

property
---
```php
property($path, $default)
```
Creates a function that returns the value at a path on a collection.

Name | Type | Description
--- | --- | ---
`$path` | `string\|function` | Path of the property to retrieve; can be nested
`$default` | `mixed` | Default value to return if nothing exists at $path


Other
===

any
---
```php
any()
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

filter
---
```php
filter()
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

groupBy
---
```php
groupBy()
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

