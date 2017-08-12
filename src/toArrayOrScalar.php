<?php

namespace Dash;

function toArrayOrScalar($value)
{
	if (is_scalar($value) || is_null($value)) {
		$result = $value;
	}
	else {
		$result = toArray($value);
	}

	return $result;
}
