<?php

namespace Dash;

/**
 * Constrains `$number` to the inclusive range [`$lower`, `$upper`].
 *
 * @category Math & numeric
 *
 * @param numeric $number
 * @param numeric $lower
 * @param numeric $upper
 * @return numeric
 *
 * @example
	Dash\clamp(15, 0, 10);
	// === 10

	Dash\clamp(-3, 0, 10);
	// === 0
 */
function clamp($number, $lower, $upper)
{
	assertType($number, 'numeric', __FUNCTION__);
	assertType($lower, 'numeric', __FUNCTION__);
	assertType($upper, 'numeric', __FUNCTION__);

	return \min($upper, \max($lower, $number));
}
