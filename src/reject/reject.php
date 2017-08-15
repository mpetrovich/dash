<?php

namespace Dash;

function reject($iterable, $predicate)
{
	return filter($iterable, negate($predicate));
}
