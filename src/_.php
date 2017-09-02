<?php

namespace Dash;

/**
 * Placeholder parameter for partial(), partialRight(), etc.
 */
const _ = "\0\0";

/**
 * Point of entry for standalone and chained operations.
 *
 * All operations can be accessed as static methods (eg. _::map() )
 * or as chained methods (eg. _::chain()->map() ).
 *
 * @example Standalone operations
	_::map([1, 2, 3], function($n) { return $n * 2; });  // === [2, 4, 6]
 *
 * @example Chained operations
	_::chain([1, 2, 3])
		->map(function($n) { return $n * 2; })
		->filter(function($n) { return $n > 2; })
		->value();  // === [4, 6]
 */
class _
{
	/**
	 * Creates a global function alias for _::chain().
	 *
	 * @param string $alias Name of the global function
	 * @return void
	 *
	 * @example Aliases _::chain() to dash()
		_::addGlobalAlias('dash');

		dash([1, 2, 3])
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // === [4, 6]
	 */
	public static function addGlobalAlias($alias = '__')
	{
		if (function_exists($alias) && !$alias() instanceof _) {
			throw new \RuntimeException("$alias() already defined");
		}

		if (!function_exists($alias)) {
			eval("function $alias() { return call_user_func_array('Dash\_::chain', func_get_args()); }");
		}
	}

	/**
	 * Starts a new chain.
	 *
	 * @param mixed $input (optional) Initial value of the chain
	 * @return _ A new chain
	 *
	 * @example
		_::chain([1, 2, 3])
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // === [4, 6]
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
	 * @return void
	 *
	 * @example Custom scalar operation
		_::setCustom('triple', function($n) { return $n * 3; });
		_::triple(4);  // === 12
	 *
	 * @example Custom collection operation
		_::setCustom('addOne', function($array) {
			return _::map($array, function($n) { return $n + 1; });
		});
		_::chain([1, 2, 3])->addOne()->value();  // === [2, 3, 4]
	 *
	 * @example Custom collection operation with parameters
		_::setCustom('addEach', function($array, $add) {
			return _::map($array, function($n) use ($add) { return $n + $add; });
		});
		_::chain([1, 2, 3])->addEach(3)->value();  // === [4, 5, 6]
	 */
	public static function setCustom($name, callable $callable)
	{
		self::$customFunctions[$name] = $callable;
	}

	/**
	 * Removes a custom operation.
	 *
	 * @param string $name Operation name
	 * @return void
	 */
	public static function unsetCustom($name)
	{
		unset(self::$customFunctions[$name]);
	}

	/**
	 * Performs an operation statically. (eg. _::map() )
	 *
	 * @param string $method Method name
	 * @param array $args Method arguments
	 * @return mixed Return value of the called method
	 *
	 * @example
		_::map([1, 2, 3], function($n) { return $n * 2; });  // === [2, 4, 6]
	 */
	public static function __callStatic($method, $args)
	{
		$callable = self::toCallable($method);
		return call_user_func_array($callable, $args);
	}

	/**
	 * Sets the initial value of a chain.
	 *
	 * @param mixed $input
	 * @return _ The chain
	 *
	 * @example With an array
		$chain = _::chain([1, 2, 3]);
		$chain->value();  // === [1, 2, 3]
	 *
	 * @example With an object
		$obj = (object) ['foo' => 'bar'];
		$chain->with($obj);
		$chain->value();  // === ['foo' => 'bar']
	 *
	 * @example With a scalar
		$chain->with(3.14);
		$chain->value();  // === 3.14
	 */
	public function with($input = null)
	{
		$this->input = $input;
		$this->output = null;
		return $this;
	}

	/**
	 * Performs an operation on the chain. (eg. _::chain()->map() )
	 *
	 * @param string $method Method name
	 * @param array $args Method args
	 * @return _ The chain
	 *
	 * @example
		_::chain([1, 2, 3])
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // === [4, 6]
	 */
	public function __call($method, $args)
	{
		if (strpos($method, '_') === 0) {
			$original = substr($method, 1);
			throw new \BadMethodCallException("Curried method $method() cannot be called in a chain. Use the non-curried $original() instead.");
		}

		$this->operations[] = $this->toOperation($method, $args);
		$this->output = null;
		return $this;
	}

	/**
	 * Executes all chained operations and returns the result.
	 *
	 * The result is cached so that multiple calls to value() on the same chain
	 * won't execute the operations more than once.
	 *
	 * @return mixed
	 *
	 * @example
		$chain = _::chain([1, 2, 3]);
		$chain->value();  // === [1, 2, 3]
	 */
	public function value()
	{
		if (!isset($this->output)) {
			$this->output = $this->getOutput($this->input);
		}

		return $this->output;
	}

	/**
	 * Alias for value().
	 *
	 * @see value()
	 * @return mixed
	 */
	public function run()
	{
		return $this->value();
	}

	/**
	 * Returns a new copy of this chain.
	 *
	 * @return _
	 */
	public function copy()
	{
		return clone $this;
	}

	/*
		Private
		------------------------------------------------------------
	 */

	/**
	 * Custom function operations.
	 *
	 * @var array
	 */
	private static $customFunctions = [];

	/**
	 * The function operations to perform.
	 *
	 * @var array
	 */
	private $operations = [];

	/**
	 * The input value of the chain.
	 *
	 * @var mixed
	 */
	private $input = null;

	/**
	 * The output value of the chain.
	 *
	 * @var mixed
	 */
	private $output = null;

	/**
	 * Returns a callable for the given Dash operation.
	 *
	 * @param string $method Dash function name
	 * @return callable Callable for $method
	 * @throws \BadMethodCallException if $method is not callable
	 */
	private static function toCallable($method)
	{
		if (isset(self::$customFunctions[$method])) {
			return self::$customFunctions[$method];
		}
		elseif (is_callable("\\Dash\\{$method}")) {
			return "\\Dash\\{$method}";
		}
		else {
			throw new \BadMethodCallException("No callable method found for \"$method\"");
		}
	}

	/**
	 * Constructs a new chain.
	 *
	 * @param mixed $input (optional) Initial value of the chain
	 * @return void
	 */
	private function __construct($input = null)
	{
		$this->with($input);
	}

	/**
	 * Wraps a method to be called with the given arguments.
	 *
	 * @param string $method Method name
	 * @param array $args Method arguments
	 * @return callable Closure that will invoke $method with $args when called
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
	 * Executes all chained operations.
	 *
	 * @param mixed $input
	 * @return array|scalar Normalized result of all operations on the given initial value
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
