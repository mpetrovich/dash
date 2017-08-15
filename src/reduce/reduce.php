<?php

namespace Dash;

function reduce($iterable, $iteratee, $result = [])
{
	foreach ($iterable as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
