<?php

namespace Dash\Collections;

function reduce($collection, $iteratee, $result = array())
{
	foreach ($collection as $key => $value) {
		$result = call_user_func($iteratee, $result, $value, $key);
	}

	return $result;
}
