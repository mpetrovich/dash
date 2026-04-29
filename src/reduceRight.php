<?php

namespace Dash;

/**
 * Iteratively reduces `$iterable` from right to left by way of `$iteratee`.
 *
 * @category Collections & iterators
 *
 * @see reduce(), reverse()
 *
 * @param iterable|stdClass|null $iterable
 * @param callable $iteratee Called with `($result, $value, $key)` for each element from right to left
 * @param mixed $initial (optional) Initial value
 * @return mixed
 */
function reduceRight($iterable, $iteratee, $initial = [])
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	return reduce(reverse($iterable, true), $iteratee, $initial);
}
