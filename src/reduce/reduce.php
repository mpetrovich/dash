<?php

namespace Dash;

function reduce($iterable, $iteratee, $initial = [])
{
	$result = $initial;

	foreach ($iterable as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
