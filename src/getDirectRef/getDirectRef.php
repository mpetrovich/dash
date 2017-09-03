<?php

namespace Dash;

/**
 * Like getDirect(), but returns a reference to the value at the given key of an iterable.
 *
 * @category Iterable: Query
 * @param iterable $iterable
 * @param string $key
 * @return mixed
 * @throws \UnexpectedValueException if no value exists at $key
 *
 * @example
	$obj = (object) ['key' => 'value'];
	$ref = Dash\getDirectRef($obj, 'key');
	$ref = 'changed';
	// $obj->key === 'changed'
 */
function &getDirectRef(&$iterable, $key)
{
	if (is_array($iterable) && array_key_exists($key, $iterable)) {
		$value = &$iterable[$key];
	}
	elseif (is_object($iterable) && property_exists($iterable, $key)) {
		$value = &$iterable->$key;
	}
	else {
		throw new \UnexpectedValueException(sprintf(
			'%s has no property "%s"',
			gettype($iterable),
			$key
		));
	}

	return $value;
}
