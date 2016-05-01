<?php

namespace Dash;

/**
 * Point of entry for performing chained operations on values.
 *
 * This class enables standalone Dash functions like map(), filter(), etc. to
 * be chained together. When performing multiple operations on a single input,
 * chaining results in clearer and shorter code.
 *
 * @example Without chaining
	Dash\Collections\filter(
		Dash\Collections\map(
			array(1, 2, 3),
			function($n) { return $n * 2; }
		),
		function($n) { return $n > 2; }
	);  // == array(4, 6)
 *
 * @example With chaining
	Dash\Dash::with(array(1, 2, 3))
		->map(function($n) { return $n * 2; })
		->filter(function($n) { return $n > 2; })
		->value();  // === array(4, 6)
 */
abstract class Dash
{
	/**
	 * Wraps a value within a new container for the purposes of chaining.
	 *
	 * @param mixed $value The value to wrap
	 *
	 * @return Container A new container that wraps the value
	 *
	 * @example
		Dash\Dash::with(array(1, 2, 3))
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n > 2; })
			->value();  // === array(4, 6)
	 */
	public static function with($value = null)
	{
		return new Container($value);
	}

	/**
	 * Enables standalone Dash functions to be called statically (eg. `Dash::map(…)`).
	 *
	 * @param string $method Method name
	 * @param array $args Method arguments
	 * @return mixed Return value of the called method
	 *
	 * @example
		Dash\Dash::map(array(1, 2, 3), function($n) { return $n * 2; })
		// === array(2, 4, 6)
	 */
	public static function __callStatic($method, $args)
	{
		$namespaces = array(
			'Dash\\Collections\\',
			'Dash\\Functions\\',
		);
		foreach ($namespaces as $namespace) {
			if (function_exists($namespace . $method)) {
				return call_user_func_array($namespace . $method, $args);
			}
		}
		throw new \Exception(sprintf('No callable method found for "%s"', $method));
	}
}
