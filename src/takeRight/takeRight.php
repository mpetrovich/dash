<?php

namespace Dash;

function takeRight($iterable, $count = 1, $fromEnd = 0)
{
	$values = mapValues($iterable);
	$reversed = reverse($values);
	return take($reversed, $count, $fromEnd);
}
