<?php

namespace Dash;

function set($input, $field, $value)
{
	if (is_array($input)) {
		$input[$field] = $value;
	}
	else if (is_object($input)) {
		$input->$field = $value;
	}
	else {
		throw new \InvalidArgumentException(sprintf(
			'set() only accepts arrays or objects; called with: %s',
			gettype($input)
		));
	}
}
