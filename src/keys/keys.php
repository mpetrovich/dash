<?php

namespace Dash;

function keys($iterable)
{
	return map($iterable, function($value, $key) {
		return $key;
	});
}
