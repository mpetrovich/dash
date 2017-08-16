<?php

namespace Dash;

function getDirect($input, $field, $default = null)
{
	if (is_array($input) && array_key_exists($field, $input)) {
		$value = $input[$field];
	}
	elseif (is_object($input) && property_exists($input, $field)) {
		$value = $input->$field;
	}
	else {
		$array = toArray($input);
		$value = isset($array[$field]) ? $array[$field] : $default;
	}

	return $value;
}
