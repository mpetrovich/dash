<?php

namespace Dash;

function last($collection)
{
	$last = end($collection);
	reset($collection);
	return $last;
}
