<?php

namespace Dash;

function last($iterable)
{
	$last = end($iterable);
	reset($iterable);
	return $last;
}
