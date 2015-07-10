# Dash
A functional utility library for PHP.


## Motivation
There are a number of existing PHP libraries with functional-like behavior:
- [brianhaveri/Underscore.php](https://github.com/brianhaveri/Underscore.php)
- [Anahkiasen/underscore-php](https://github.com/Anahkiasen/underscore-php)
- [lstrojny/functional-php](https://github.com/lstrojny/functional-php)
- [emonkak/underbar.php](https://github.com/emonkak/underbar.php)
- [bdelespierre/underscore.php](https://github.com/bdelespierre/underscore.php)
- [maciejczyzewski/bottomline](https://github.com/maciejczyzewski/bottomline)
- [alairock/lodash-php](https://github.com/alairock/lodash-php)

However, none of them satisfy *all* of the following requirements:
- PHP 5.3 compatible (because [5.3 is still used by a majority](http://w3techs.com/technologies/details/pl-php/5/all))
- Works natively with all `Traversible` types, not just native arrays
- Built-in chaining (eg. `_([2, 1, 3])->sort()->take(2)`)
- True functional behavior including currying and partial application
- Extensive set of methods
- In active development
- Detailed documentation in English
- Comprehensive unit tests
- Modular codebase that facilitates outside contribution


## Philosophy
Dash follows several core principles:
- **Clear** is better than clever
- **Simple** is better than customizable
- **Explicit** is better than implicit
- **Maintainable** is better than performant

This is not to say that Dash is never clever, customizable, implicit, nor performant, but rather that those characteristics are less important than being clear, simple, explicit, and maintainable.


## Installation
Dash can be installed via [Composer](https://getcomposer.org/):
```sh
composer require mpetrovich/dash
```


## Usage
All Dash functionality lies within the `Dash` namespace, which contains additional sub-namespaces:
- `Dash\Collection`: Functions for operating on arrays or objects
- `Dash\Array`: Functions for operating on arrays
- `Dash\Object`: Functions for operating on objects
- `Dash\String`: Functions for operating on strings
- `Dash\Function`: Functions for operating on functions

Functions within each sub-namespace can be used for one-off computations. For example:

```php
Dash\Collection\map(
	array(1, 2, 3),
	function($n) { return $n * 2; }
);  // == array(2, 4, 6)
```

If more than operation needs to be performed on a single input, then operations should be chained via the `Dash\Dash` class instead. For example:

```php
Dash\Dash::with(array(1, 2, 3))
	->map(function($n) { return $n * 2; })
	->filter(function($n) { return $n > 2; })
	->value();  // == array(4, 6)
```

When chaining, `value()` must *always* be called in order to retrieve the wrappped value. Contrast this behavior with most other libraries. This was done in order to reduce confusion about when to/not to call `value()` by making the value unwrapping always explicit.


## API

### Collection
- [x] `map(collection, iteratee)`
- [x] `mapValues(collection, iteratee)`
- [ ] `pluck(collection, path)`
- [ ] `reduce(collection, iteratee, result)`
- [x] `each(collection, iteratee)`
- [ ] `filter(collection, predicate)`
- [ ] `reject(collection, predicate)`
- [ ] `any(collection, predicate)`
- [ ] `every(collection, predicate)`
- More coming soon…

### Array
- [ ] `first(array)`
- [ ] `last(array)`
- [ ] `take(array, count)`
- [ ] `takeRight(array, count)`
- More coming soon…

### Objects
- [ ] `property(path, [default=null])`
- [ ] `get(object, path, [default=null])`
- More coming soon…

### String
- Coming soon…

### Function
- [ ] `negate(predicate)`
- [ ] `partial(func, [arg1, arg2, ...])`
- [ ] `partialRight(func, [..., argN-1, argN])`
- More coming soon…


## Roadmap

- *Soon* - Automatic partial application
- *Soon* - Deferred evaluation
- *Later* - Lazy evaluation

More coming soon…


## Contributing
Coming soon…
