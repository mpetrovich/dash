<?php

namespace Dash;

function reverse($collection)
{
	return array_reverse(
		mapValues($collection),
		true  // Preserves numeric keys
	);
}
