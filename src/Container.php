<?php

namespace Dash;

/**
 * Wrapper that encapsulates a value and its chained operations.
 *
 * This class should not be instantiated directly; instead, use
 * Dash\_::with() which returns a new Container instance whose methods are
 * used to chain operations like so:
 *
 *     Dash\_::with(array(1, 2, 3))
 *         ->map(function($n) { return $n * 2; })
 *         ->filter(function($n) { return $n > 2; })
 *         ->value();  // == array(4, 6)
 */
class Container
{
	/**
	 * Initializes a new container with a value.
	 *
	 * @internal This is only used internally; use Dash\_::with() instead
 	 * @see Dash\_::with()
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
		$this->operations[] = $this->getOperation($method, $arguments);
		return $this;
	}

	private function getOperation($method, $arguments)
	{
		$callable = $this->getCallable($method);

		if (!$callable) {
			throw new \Exception("No callable method found for \"{$method}\"");
		}

		$operation = function($value) use ($callable, $arguments) {
			array_unshift($arguments, $value);
			return call_user_func_array($callable, $arguments);
		};

		return $operation;
	}

	private function getCallable($method)
	{
		$callable = "\\Dash\\{$method}";
		return is_callable($callable) ? $callable : null;
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
		if ($value instanceof Traversable) {
			$this->value = iterator_to_array($value);
		}
		else if (is_object($value)) {
			$this->value = array();
			foreach ($value as $key => $val) {
				$this->value[$key] = $val;
			}
		}
		else {
			$this->value = $value;
		}

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
		$container->value();  // == array(2, 4, 6)
	 */
	public function value()
	{
		if ($this->value !== null) {
			$this->execute();
		}

		return $this->value;
	}

	private function execute()
	{
		foreach ($this->operations as $operation) {
			$result = call_user_func($operation, $this->value);
			$this->with($result);
		}
	}

	private $operations = array();

	/**
	 * The current wrapped value.
	 *
	 * @var mixed
	 */
	protected $value = array();
}
