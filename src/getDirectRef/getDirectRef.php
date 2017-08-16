<?php

namespace Dash;

function &getDirectRef(&$subject, $field)
{
	if (is_array($subject) && array_key_exists($field, $subject)) {
		$value = &$subject[$field];
	}
	elseif (is_object($subject) && property_exists($subject, $field)) {
		$value = &$subject->$field;
	}
	else {
		throw new \UnexpectedValueException(sprintf(
			'%s has no property "%s"',
			gettype($subject),
			$field
		));
	}

	return $value;
}
