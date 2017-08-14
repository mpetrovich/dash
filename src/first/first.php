<?php

namespace Dash;

function first($collection)
{
	return isset($collection[0]) ? $collection[0] : null;
}
