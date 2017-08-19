<?php

namespace Dash;

/**
 * Checks whether a value has a direct child field.
 *
 * @param mixed $input
 * @param string $field Name of the field
 * @return boolean
 *
 * @example
	hasDirect(['a' => ['b' => 1, 'c' => 2], 'a');  // === true
	hasDirect(['a' => ['b' => 1, 'c' => 2], 'b');  // === false
 *
 * @example
	hasDirect((object) ['a' => 1, 'b' => 2], 'b');  // === true
 */
function hasDirect($input, $field)
{
	return is_array($input) && array_key_exists($field, $input)
		|| is_object($input) && property_exists($input, $field)
		|| $input instanceof \ArrayAccess && $input->offsetExists($field);
}
