<?php

namespace Dash;

function findLast($iterable, $predicate)
{
	$values = mapValues($iterable);
	$reversed = reverse($values);
	return find($reversed, $predicate);
}
