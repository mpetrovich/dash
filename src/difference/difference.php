<?php

namespace Dash;

function difference()
{
	$iterables = func_get_args();
	$union = union($iterables);
	$intersection = intersection($iterables);
	$difference = without($union, $intersection);
	$difference = values($difference);  // Re-indexes array

	return $difference;
}
