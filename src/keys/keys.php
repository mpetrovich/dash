<?php

namespace Dash;

function keys($collection)
{
	return map($collection, function($value, $key) {
		return $key;
	});
}
