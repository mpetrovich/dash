<?php

namespace Dash;

/**
 * Wrapper that encapsulates a value and its chained operations.
 *
 * This class should not be instantiated directly; instead, use
 * Dash\Dash::with() which return a new Container instance whose methods are
 * used to chain operations like so:
 *
 *     Dash\Dash::with(array(1, 2, 3))
 *         ->map(function($n) { return $n * 2; })
 *         ->filter(function($n) { return $n > 2; })
 *         ->value();  // == array(4, 6)
 *
 * @method Container map($collection, $iteratee)
 * @method Container mapValues($collection, $iteratee)
 * @method Container each($collection, $iteratee)
 */
class Container
{
	/**
	 * Initializes a new container with a value.
	 *
	 * @internal This is only used internally; use Dash\Dash::with() instead
 	 * @see Dash\Dash::with()
	 *
	 * @param mixed $value The initial value
	 *
	 * @return void
	 */
	public function __construct($value = array())
	{
		$this->with($value);
	}

	/**
	 * Enables standalone Dash functions to be called as instance methods.
	 *
	 * @param string $method
	 * @param array $arguments
	 *
	 * @return Container The container instance
	 *
	 * @example
		$container = new Container(array(1, 2, 3));
		$container
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // == array(4, 6)
	 */
	public function __call($method, $arguments)
	{
		$namespaces = array(
			'Dash\Collection',
			'Dash\Array',
			'Dash\Object',
			'Dash\String',
			'Dash\Function',
		);

		// @todo Replace loop with Dash\Collection\find()
		foreach ($namespaces as $namespace) {
			$qualifiedMethod = $namespace . '\\' . $method;
			if (function_exists($qualifiedMethod)) {
				$arguments = array_merge(array($this->value), $arguments);
				$result = call_user_func_array($qualifiedMethod, $arguments);
				$this->with($result);
				break;
			}
		}

		return $this;
	}

	/**
	 * Sets the value of the container.
	 *
	 * The existing value will be wholly replaced with the given value.
	 *
	 * @param mixed $value The new value
	 *
	 * @return Container The container instance
	 *
	 * @example
		$container = new Container(array(1, 2, 3));
		$container->with(array(4, 5));
		$container->value();  // == array(4, 5)
	 */
	public function with($value = array())
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Gets the current value wrapped within the container.
	 *
	 * @return mixed
	 *
	 * @example
		$container = new Container(array(1, 2, 3));
		$container->value();  // == array(1, 2, 3)
		$container->map(function($n) { return $n * 2; })
		$container->value();  // == array(4, 6)
	 */
	public function value()
	{
		return $this->value;
	}

	/**
	 * The current wrapped value.
	 *
	 * @var mixed
	 */
	private $value = array();
}
