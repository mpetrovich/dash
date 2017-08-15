<?php

namespace Dash;

function reverse($iterable)
{
	return array_reverse(
		mapValues($iterable),
		true  // Preserves numeric keys
	);
}
