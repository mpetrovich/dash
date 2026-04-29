<?php

namespace Dash;

/**
 * Checks whether `$value` is a date/time object.
 *
 * @category Type & value checks
 *
 * @param mixed $value
 * @return boolean
 */
function isDate($value)
{
	return $value instanceof \DateTimeInterface;
}
