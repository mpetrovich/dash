<?php

namespace Dash\Generator;

/**
 * @see Dash\range()
 */
// @codingStandardsIgnoreLine
function range($start, $end = null, $step = 1)
{
	$start = $start + 0;
	$step = $step + 0;

	if (is_null($end)) {
		$end = $start;
		$start = 0;
	}
	else {
		$end = $end + 0;
	}

	if ($step > 0) {
		for ($i = $start; $i < $end; $i += $step) {
			yield $i;
		}
	}
	else {
		for ($i = $start; $i > $end; $i += $step) {
			yield $i;
		}
	}
}
