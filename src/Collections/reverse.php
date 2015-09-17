<?php

namespace Dash\Collections;

function reverse($collection)
{
	return array_reverse(
		mapValues($collection),
		true  // Preserves numeric keys
	);
}
