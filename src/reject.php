<?php

namespace Dash;

function reject($collection, $predicate)
{
	return filter($collection, negate($predicate));
}
