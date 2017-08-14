<?php

namespace Dash;

function every($collection, $predicate)
{
	if (isEmpty($collection)) {
		return true;
	}

	return !any($collection, negate($predicate));
}
