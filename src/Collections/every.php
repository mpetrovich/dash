<?php

namespace Dash\Collections;

use Dash\Functions;

function every($collection, $predicate)
{
	if (isEmpty($collection)) {
		return true;
	}

	return !any($collection, Functions\negate($predicate));
}
