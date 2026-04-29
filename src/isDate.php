<?php

namespace Dash;

/**
 * Checks whether `$value` is a date/time object.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 *
 * @example
	Dash\isDate(new \DateTimeImmutable());
	// === true
 */
function isDate($value)
{
	return $value instanceof \DateTimeInterface;
}
