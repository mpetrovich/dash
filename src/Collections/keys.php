<?php

namespace Dash\Collections;

function keys($collection)
{
	return map($collection, function($value, $key) {
		return $key;
	});
}
