<?php

namespace Dash;

function findLast($collection, $predicate)
{
	$values = mapValues($collection);
	$reversed = reverse($values);
	return find($reversed, $predicate);
}
