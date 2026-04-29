<?php

namespace Dash;

/**
 * Constrains `$number` to the inclusive range [`$lower`, `$upper`].
 *
 * @param numeric $number
 * @param numeric $lower
 * @param numeric $upper
 * @return numeric
 */
function clamp($number, $lower, $upper)
{
	assertType($number, 'numeric', __FUNCTION__);
	assertType($lower, 'numeric', __FUNCTION__);
	assertType($upper, 'numeric', __FUNCTION__);

	return \min($upper, \max($lower, $number));
}
