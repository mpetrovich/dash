<?php

namespace Dash;

function reverse($iterable)
{
	return array_reverse(
		toArray($iterable),
		true  // Preserves numeric keys
	);
}
