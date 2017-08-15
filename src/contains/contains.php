<?php

namespace Dash;

function contains($iterable, $target, $predicate = null)
{
	if ($predicate === null) {
		$predicate = 'Dash\equal';
	}

	foreach ($iterable as $value) {
		if (call_user_func($predicate, $target, $value)) {
			return true;
		}
	}

	return false;
}
