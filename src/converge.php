<?php

namespace Dash;

/**
 * Creates a function that applies each branch function to the same runtime arguments, then passes
 * branch results as positional arguments to `$combiner`.
 *
 * @param callable $combiner
 * @param iterable|stdClass|null $branches
 * @return callable
 *
 * @example
	$avg = Dash\converge(function ($sum, $count) {
		return $sum / $count;
	}, [
		'Dash\sum',
		'Dash\size',
	]);
	$avg([2, 4, 6]);  // === 4
 */
function converge(callable $combiner, $branches)
{
	assertType($branches, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	$branches = toArray($branches);

	return function () use ($combiner, $branches) {
		$args = func_get_args();
		$results = [];

		foreach ($branches as $branch) {
			$results[] = call_user_func_array($branch, $args);
		}

		return call_user_func_array($combiner, $results);
	};
}
