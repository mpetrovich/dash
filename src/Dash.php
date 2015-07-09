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
	Dash\Collection\filter(
		Dash\Collection\map(
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
		->value();  // == array(4, 6)
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
			->value();  // == array(4, 6)
	 */
	public static function with($value = null)
	{
		return new Container($value);
	}
}
