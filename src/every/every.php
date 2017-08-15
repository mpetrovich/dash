<?php

namespace Dash;

function every($iterable, $predicate)
{
	if (isEmpty($iterable)) {
		return true;
	}

	return !any($iterable, negate($predicate));
}
