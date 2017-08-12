<?php

namespace Dash;

function reduce($collection, $iteratee, $result = [])
{
	foreach ($collection as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
