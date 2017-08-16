<?php

namespace Dash;

function getDirect($subject, $field, $default = null)
{
	if (is_array($subject) && array_key_exists($field, $subject)) {
		$value = $subject[$field];
	}
	elseif (is_object($subject) && property_exists($subject, $field)) {
		$value = $subject->$field;
	}
	else {
		$value = $default;
	}

	return $value;
}
