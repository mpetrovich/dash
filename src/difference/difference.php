<?php

namespace Dash;

function difference(/* $iterable1, $iterable2, ... */)
{
	$iterables = func_get_args();
	$union = union($iterables);
	$intersection = intersection($iterables);
	$difference = without($union, $intersection);
	$difference = values($difference);  // Re-indexes array

	return $difference;
}
