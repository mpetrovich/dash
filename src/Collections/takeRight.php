<?php

namespace Dash\Collections;

function takeRight($collection, $count = 1, $fromEnd = 0)
{
	$values = mapValues($collection);
	$reversed = reverse($values);
	return take($reversed, $count, $fromEnd);
}
