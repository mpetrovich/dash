<?php

namespace Dash;

function pick($input, $fields)
{
	$fields = (array) $fields;
	$picked = [];

	foreach ($input as $field => $value) {
		if (in_array($field, $fields)) {
			$picked[$field] = $value;
		}
	}

	return is_object($input) ? (object) $picked : $picked;
}
