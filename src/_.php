<?php

namespace Dash;

/**
 * Placeholder parameter for partial(), curry(), etc.
 * @see partial(), curry()
 */
const _ = "\0\0";

/**
 * Used to manage and access operations.
 *
 * All operations can be accessed as standalone static methods (eg. `_::map()`)
 * or as chained methods (eg. `_::chain()->map()`).
 *
 * @example As standalone operations
	_::map([1, 2, 3], function ($n) { return $n * 2; });
	// === [2, 4, 6]
 *
 * @example As chained operations
	_::chain([1, 2, 3])
		->filter(function ($n) { return $n < 3; })
		->map(function ($n) { return $n * 2; })
		->value();
	// === [2, 4]
 */
class _
{
	/**
	 * Creates a global function alias for `_::chain()`.
	 *
	 * Note: This method should only be called once per `$alias`.
	 *
	 * @param string $alias Name of the global function to create
	 * @return void
	 * @throws RuntimeException if a global function with the same name already exists
	 *
	 * @example Aliases `_::chain()` to `dash()`
		_::addGlobalAlias('dash');

		dash([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; })
			->value();
		// === [2, 4]
	 */
	public static function addGlobalAlias($alias = '__')
	{
		if (function_exists($alias)) {
			throw new \RuntimeException("A global function $alias() already exists");
		}

		if (!function_exists($alias)) {
			eval("function $alias() { return call_user_func_array('Dash\_::chain', func_get_args()); }");
		}
	}

	/**
	 * Creates a new chain.
	 *
	 * @param mixed $input (optional) Initial input value of the chain
	 * @return Dash\_ A new chain
	 *
	 * @example
		_::chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; })
			->value();
		// === [2, 4]
	 */
	public static function chain($input = null)
	{
		return new self($input);
	}

	/**
	 * Sets a custom operation.
	 *
	 * A custom operation with the same name as a built-in operation
	 * will override the built-in operation.
	 *
	 * @param string $name Operation name
	 * @param callable $callable Operation function
	 * @param boolean $makeCurryable (optional) If true, a curried variant of the operation will also be added,
	 *                               with arguments rotated by 1 so that the first argument is now last,
	 *                               the second argument is now first, the third is now second, and so on
	 * @return void
	 * @throws Exception when attempting to create a custom method with the same name as a built-in Dash operation
	 *
	 * @example Custom operation for numbers
		_::setCustom('triple', function ($n) { return $n * 3; });
		_::triple(4);
		// === 12
	 *
	 * @example Custom operation for iterables
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		});
		_::chain([1, 2, 3])->addEach(3)->value();
		// === [4, 5, 6]
	 *
	 * @example With automatic currying
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$add3 = _::_addEach(3);
		$add3([1, 2, 3]);
		// === [4, 5, 6]
	 */
	public static function setCustom($name, callable $callable, $makeCurryable = true)
	{
		if (is_callable("\\Dash\\$name")) {
			throw new \Exception(
				"Cannot create a custom method named '$name'; Dash\\$name() already exists and cannot be overridden"
			);
		}

		self::$customFunctions[$name] = $callable;

		if ($makeCurryable) {
			$curried = function () use ($callable) {
				return currify($callable, func_get_args());
			};
			self::$customFunctions["_$name"] = $curried;
		}
	}

	/**
	 * Removes a custom operation.
	 *
	 * @param string $name Name of the operation that was added via `setCustom()`
	 * @return void
	 *
	 * @example
		_::setCustom('triple', function ($n) { return $n * 3; });
		_::triple(4);  // === 12
		_::unsetCustom('triple');
		_::triple(4);  // Throws an exception
	 */
	public static function unsetCustom($name)
	{
		unset(self::$customFunctions[$name], self::$customFunctions["_$name"]);
	}

	/**
	 * Executes a standalone operation.
	 *
	 * @param string $method Method name
	 * @param array $args Method arguments
	 * @return mixed Return value of the method
	 * @throws BadMethodCallException if an invalid operation is called
	 *
	 * @example
		_::map([1, 2, 3], function($n) { return $n * 2; });
		// === [2, 4, 6]
	 */
	public static function __callStatic($method, $args)
	{
		$callable = self::toCallable($method);
		return call_user_func_array($callable, $args);
	}

	/**
	 * Sets the input value of a chain.
	 *
	 * Can be called multiple times on the same chain.
	 *
	 * @param mixed $input
	 * @return _ The chain
	 *
	 * @example With an array
		_::chain()->with([1, 2, 3])->value();
		// === [1, 2, 3]
	 *
	 * @example With an stdClass
		_::chain()->with((object) ['a' => 1, 'b' => 2, 'c' => 3])->value();
		// === (object) ['a' => 1, 'b' => 2, 'c' => 3]
	 *
	 * @example With a number
		_::chain()->with(3.14)->value();
		// === 3.14
	 */
	public function with($input = null)
	{
		$this->input = $input;
		$this->output = null;
		return $this;
	}

	/**
	 * Executes all chained operations with the latest input.
	 *
	 * The result is cached, and multiple calls to value() will returned the cached value
	 * until the input value is changed or more operations are added to the chain.
	 *
	 * @return mixed The result of all chained operations on the input
	 *
	 * @example
		$chain = _::chain([1, 2, 3])->map(function ($n) { return $n * 2; });
		// map() is not called yet

		$chain->value();
		// Only now is map() called
		// === [2, 4, 6]
	 */
	public function value()
	{
		if (!isset($this->output)) {
			$this->output = $this->getOutput($this->input);
		}

		return $this->output;
	}

	/**
	 * Alias for value(). Useful for chains whose output is not needed.
	 *
	 * @see value()
	 * @return mixed
	 *
	 * @example
		_::chain([1, 2, 3])
			->each(function ($n) { echo $n; })
			->run();
		// Prints: 123
	 */
	public function run()
	{
		return $this->value();
	}

	/**
	 * Returns a new, independent copy of this chain.
	 *
	 * Future changes to this copy will not affect this original chain.
	 * This method is the same as cloning the chain.
	 *
	 * @return _
	 *
	 * @example
		$original = _::chain()->map(function ($n) { return $n * 2; });

		$original->with([1, 2, 3]);
		$original->value();
		// === [2, 4, 6]

		$copy = $original->copy();
		$copy->map(function ($n) { return $n + 1; });

		$copy->with([4, 5, 6]);
		$copy->value();
		// === [9, 11, 13]

		$original->with([1, 2, 3]);
		$original->value();
		// === [2, 4, 6]
	 */
	public function copy()
	{
		return clone $this;
	}

	/**
	 * Executes a chained operation on this chain.
	 *
	 * @param string $method Method name
	 * @param array $args Method args
	 * @return _ The chain
	 * @throws BadMethodCallException if `$method` is curried, because only uncurried methods can be chained
	 *
	 * @example
		_::chain([1, 2, 3])
			->filter(function($n) { return $n < 3; })
			->map(function($n) { return $n * 2; })
			->value();
		// === [2, 4]
	 */
	public function __call($method, $args)
	{
		$isCurried = (strpos($method, '_') === 0);

		if ($isCurried) {
			$original = substr($method, 1);
			throw new \BadMethodCallException(
				"Curried method $method() cannot be called in a chain; use the uncurried $original() method instead"
			);
		}

		$this->operations[] = $this->toOperation($method, $args);
		$this->output = null;
		return $this;
	}

	/*
		Private
		------------------------------------------------------------
	 */

	/**
	 * Custom operation functions.
	 *
	 * @var array of operation name => callable
	 */
	private static $customFunctions = [];

	/**
	 * The function operations to execute on this chain.
	 *
	 * @var array of callable
	 */
	private $operations = [];

	/**
	 * The current input value of this chain.
	 *
	 * @var mixed
	 */
	private $input = null;

	/**
	 * The cached output value (if any) of this chain.
	 *
	 * @var mixed
	 */
	private $output = null;

	/**
	 * Returns a callable function for the specified operation.
	 *
	 * @param string $method Operation name (built-in or custom)
	 * @return callable Callable function for `$method`
	 * @throws BadMethodCallException if `$method` is not callable
	 */
	private static function toCallable($method)
	{
		if (is_callable("\\Dash\\$method")) {
			return "\\Dash\\$method";
		}
		elseif (isset(self::$customFunctions[$method])) {
			return self::$customFunctions[$method];
		}
		else {
			throw new \BadMethodCallException("No operation named '$method' found");
		}
	}

	/**
	 * Constructs a new chain.
	 *
	 * @param mixed $input (optional) Input value of the chain
	 * @return void
	 */
	private function __construct($input = null)
	{
		$this->with($input);
	}

	/**
	 * Creates a new callable function that will invoke `$method` with `$args`.
	 *
	 * @param string $method Method name
	 * @param array $args Method arguments
	 * @return callable Callable function that will invoke `$method` with `$args` when called
	 */
	private function toOperation($method, $args)
	{
		$callable = self::toCallable($method);

		$operation = function ($input) use ($callable, $args) {
			array_unshift($args, $input);
			return call_user_func_array($callable, $args);
		};

		return $operation;
	}

	/**
	 * Gets the result of all chained operations using `$input` as the initial input value.
	 *
	 * @param mixed $input
	 * @return array|scalar Result of all operations on `$input`
	 */
	private function getOutput($input)
	{
		$output = $input;

		foreach ($this->operations as $operation) {
			$output = call_user_func($operation, $output);
		}

		return $output;
	}
}
