<?php

namespace Dash\Collections;

use Dash\Functions;

function reject($collection, $predicate)
{
	return filter($collection, Functions\negate($predicate));
}
