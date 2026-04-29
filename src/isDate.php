<?php

namespace Dash;

/**
 * Checks whether `$value` is a date/time object.
 *
 * @param mixed $value
 * @return boolean
 */
function isDate($value)
{
	return $value instanceof \DateTimeInterface;
}
