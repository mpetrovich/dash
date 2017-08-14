<?php

namespace Dash;

function set(&$input, $path, $value)
{
	$keys = explode('.', $path);

	for ($target = &$input; $keys;) {
		$key = array_shift($keys);

		if (!isset($target)) {
			$target = [];
		}

		if (is_array($target)) {
			if (!isset($target[$key])) {
				$target[$key] = [];
			}
			$target = &$target[$key];
		}
		else if (is_object($target)) {
			if (!isset($target->$key)) {
				$target->$key = new \stdClass;
			}
			$target = &$target->$key;
		}
		else {
			break;
		}
	}

	$target = $value;

	return $input;
}
