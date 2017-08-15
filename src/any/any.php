<?php

namespace Dash;

function any($iterable, $predicate)
{
	if (isEmpty($iterable)) {
		return false;
	}

	foreach ($iterable as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			return true;
		}
	}

	return false;
}
