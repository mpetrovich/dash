<?php

namespace Dash;

/**
 * Creates a function that dispatches to the first matching predicate/transform pair.
 *
 * Each pair must be `[$predicate, $transform]`. Returned function evaluates predicates in order
 * and invokes the transform for the first truthy predicate. Returns `null` if no predicate matches.
 *
 * @category Functions & composition
 *
 * @param iterable|stdClass|null $pairs
 * @return callable
 *
 * @throws InvalidArgumentException if a pair is malformed or contains non-callables
 *
 * @example
	$fn = Dash\cond([
		[function ($n) { return $n < 0; }, function () { return 'neg'; }],
		[function ($n) { return $n > 0; }, function () { return 'pos'; }],
	]);
	$fn(-1);  // === 'neg'
	$fn(0);   // === null
 */
function cond($pairs)
{
	assertType($pairs, ['iterable', 'stdClass', 'null'], __FUNCTION__);
	$pairs = toArray($pairs);

	foreach ($pairs as $index => $pair) {
		$pair = toArray($pair);
		$isValid = count($pair) === 2
			&& is_callable($pair[0])
			&& is_callable($pair[1]);

		if (!$isValid) {
			throw new \InvalidArgumentException("Pair at index {$index} must be [callable, callable]");
		}
	}

	return function () use ($pairs) {
		$args = func_get_args();

		foreach ($pairs as $pair) {
			list($predicate, $transform) = values($pair);

			if (call_user_func_array($predicate, $args)) {
				return call_user_func_array($transform, $args);
			}
		}

		return null;
	};
}
