<?php

namespace Dash;

/**
 * Returns an array of numbers from `$start` (inclusive) to `$end` (exclusive), stepping by `$step`.
 *
 * With one argument, range is `[0, $start)`.
 *
 * @category Collections & iterators
 *
 * @param numeric $start
 * @param numeric|null $end (optional)
 * @param numeric $step (optional)
 * @return array
 *
 * @throws InvalidArgumentException if `$step` is 0
 */
function range($start, $end = null, $step = 1)
{
	assertType($start, 'numeric', __FUNCTION__);
	assertType($end, ['numeric', 'null'], __FUNCTION__);
	assertType($step, 'numeric', __FUNCTION__);

	$start = $start + 0;
	$step = $step + 0;

	if (is_null($end)) {
		$end = $start;
		$start = 0;
	}
	else {
		$end = $end + 0;
	}

	if ($step == 0) {
		throw new \InvalidArgumentException('Dash\range expects non-zero $step');
	}

	$out = [];

	if ($step > 0) {
		for ($i = $start; $i < $end; $i += $step) {
			$out[] = $i;
		}
	}
	else {
		for ($i = $start; $i > $end; $i += $step) {
			$out[] = $i;
		}
	}

	return $out;
}
