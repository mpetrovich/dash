<?php

namespace Dash;

/**
 * Similar to `getDirect()`, but returns a reference to the value at `$key` within `$input`.
 *
 * This operation does not have a curried variant.
 *
 * @see getDirect(), hasDirect()
 *
 * @category Utility
 * @param array|object|ArrayAccess $input
 * @param string $key Array offset or object property name
 * @return mixed Reference to `$key` within `$input`
 * @throws UnexpectedValueException if no value exists at `$key`
 *
 * @example
	$array = ['key' => 'value'];
	$ref = &Dash\getDirectRef($array, 'key');
	$ref = 'changed';
	// $array['key'] === 'changed'

	$object = (object) ['key' => 'value'];
	$ref = &Dash\getDirectRef($object, 'key');
	$ref = 'changed';
	// $object->key === 'changed'
 */
function &getDirectRef(&$input, $key)
{
	if ($input instanceof \ArrayAccess && $input->offsetExists($key)) {
		$value = &$input[$key];
	}
	elseif (is_array($input) && array_key_exists($key, $input)) {
		$value = &$input[$key];
	}
	elseif (is_object($input) && property_exists($input, $key)) {
		$value = &$input->$key;
	}
	else {
		throw new \UnexpectedValueException(sprintf(
			'%s has no property "%s"',
			is_object($input) ? get_class($input) : gettype($input),
			$key
		));
	}

	return $value;
}
