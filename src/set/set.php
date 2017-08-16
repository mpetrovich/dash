<?php

namespace Dash;

function set(&$input, $path, $value)
{
	$steps = explode('.', $path);

	for ($target = &$input; $steps;) {
		$step = array_shift($steps);

		if (!isset($target)) {
			$target = [];
		}

		$hasDirect = hasDirect($target, $step);

		if (!$hasDirect && is_array($target)) {
			$target[$step] = [];
		}
		elseif (!$hasDirect && is_object($target)) {
			$target->$step = (object) [];
		}

		$target = &getDirectRef($target, $step);
	}

	$target = $value;

	return $input;
}
