<?php

namespace Dash;

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
	 * Starts a new chain.
	 *
	 * @param mixed $initialValue (optional) Initial value of the chain
	 * @return _ A new chain
	 *
	 * @example
		_::chain([1, 2, 3])
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // === [4, 6]
	 */
	public static function chain($initialValue = null)
	{
		return new self($initialValue);
	}

	/**
	 * Sets a custom operation.
	 *
	 * Any existing custom operation with the same name will be replaced.
	 * However, built-in Dash operations cannot be replaced.
	 *
	 * @param string $name Operation name
	 * @param callable $callable Operation function
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
	 * @param mixed $initialValue
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
	public function with($initialValue = null)
	{
		$this->initialValue = $initialValue;
		$this->finalValue = null;
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
		$this->operations[] = $this->toOperation($method, $args);
		$this->finalValue = null;
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
		if (!isset($this->finalValue)) {
			$this->finalValue = $this->executeOperations($this->initialValue);
		}

		return $this->finalValue;
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
	 * The initial value of the chain.
	 *
	 * @var mixed
	 */
	private $initialValue = null;

	/**
	 * The final value of the chain.
	 *
	 * @var mixed
	 */
	private $finalValue = null;

	/**
	 * Returns a callable for the given Dash operation.
	 *
	 * @param string $method Dash function name
	 * @return callable Callable for $method
	 * @throws \BadMethodCallException if $method is not callable
	 */
	private static function toCallable($method)
	{
		$callable = "\\Dash\\{$method}";

		if (is_callable($callable)) {
			return $callable;
		}
		else if (isset(self::$customFunctions[$method])) {
			return self::$customFunctions[$method];
		}
		else {
			throw new \BadMethodCallException("No callable method found for \"{$method}\"");
		}
	}

	/**
	 * Constructs a new chain.
	 *
	 * @param mixed $initialValue (optional) Initial value of the chain
	 * @return void
	 */
	private function __construct($initialValue = null)
	{
		$this->with($initialValue);
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

		$operation = function($value) use ($callable, $args) {
			array_unshift($args, $value);
			return call_user_func_array($callable, $args);
		};

		return $operation;
	}

	/**
	 * Executes all chained operations.
	 *
	 * @param mixed $initialValue
	 * @return array|scalar Normalized result of all operations on the given initial value
	 */
	private function executeOperations($initialValue)
	{
		$value = $initialValue;

		foreach ($this->operations as $operation) {
			$value = call_user_func($operation, $value);
		}

		return $value;
	}
}
