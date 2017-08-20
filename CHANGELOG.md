Changelog
===
- [Planned](#planned)
- [0.6.0](#060)
- [0.5.0](#050)
- [0.4.0](#040)
- [0.3.0](#030)
- [0.2.0](#020)
- [0.1.0](#010)


Planned
---
- Feature-parity with similar libraries
- Performance improvements


0.6.0
---
- Breaking changes:
	- Renamed `_::execute()` to `_::run()`
	- Renamed `_::setGlobalAlias()` to `_::addGlobalAlias()`
- New operations:
	- `apply()`
	- `ary()`
	- `call()`
	- `copy()`
	- `custom()`
	- `display()`
	- `dropWhile()`
	- `getDirect()`
	- `getDirectRef()`
	- `hasDirect()`
	- `is()`
	- `result()`


0.5.0
---
- New operations:
	- `join()`
	- `takeWhile()`
- Adds `_::addGlobalAlias()` to create a global function alias for `_::chain()`, eg. `__([1, 2, 3])->map(…)`
- Adds `execute()` as an alias to `value()`
- Fixes `toArray()` with `DirectoryIterator`
- Adds auto-generated operator documentation


0.4.0
---
- New operations:
	- `all()`
	- `assertType()`
	- `groupBy()`
	- `indexBy()`
	- `keyBy()`
	- `set()`
- Fixes issues with non-array inputs


0.3.0
---
- Added ability to add custom functions via `setCustom()`


0.2.0
---
- Breaking changes:
	- Renamed `Dash\Dash` class to `Dash\_`
	- Renamed `::with()` to `::chain()`
	- Removed `Dash\Collections` and `Dash\Functions` sub-namespaces; now all functions are in the root `Dash` namespace
	- Removed support for PHP 5.3


0.1.0
---
- Standalone and chained usage
- Deferred evaluation
- Initial operations:
	- `any()`
	- `at()`
	- `average()`
	- `compare()`
	- `contains()`
	- `deltas()`
	- `difference()`
	- `each()`
	- `equal()`
	- `every()`
	- `filter()`
	- `find()`
	- `findKey()`
	- `findLast()`
	- `findValue()`
	- `first()`
	- `get()`
	- `identical()`
	- `identity()`
	- `intersection()`
	- `isEmpty()`
	- `isEven()`
	- `isOdd()`
	- `keys()`
	- `last()`
	- `map()`
	- `mapValues()`
	- `matches()`
	- `matchesProperty()`
	- `max()`
	- `median()`
	- `min()`
	- `negate()`
	- `partial()`
	- `partialRight()`
	- `pluck()`
	- `property()`
	- `reduce()`
	- `reject()`
	- `reverse()`
	- `size()`
	- `sort()`
	- `sum()`
	- `take()`
	- `takeRight()`
	- `thru()`
	- `toArray()`
	- `union()`
	- `values()`
	- `where()`
	- `without()`
