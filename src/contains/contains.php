<?php

namespace Dash;

function contains($collection, $target, $predicate = null)
{
	if ($predicate === null) {
		$predicate = 'Dash\equal';
	}

	foreach ($collection as $value) {
		if (call_user_func($predicate, $target, $value)) {
			return true;
		}
	}

	return false;
}
