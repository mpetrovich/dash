<?php

namespace Dash\Collections;

use Dash\Functions;

function contains($collection, $target, $predicate = null)
{
	if ($predicate === null) {
		$predicate = 'Dash\Functions\equal';
	}

	foreach ($collection as $value) {
		if (call_user_func($predicate, $target, $value)) {
			return true;
		}
	}

	return false;
}
