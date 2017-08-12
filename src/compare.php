<?php

namespace Dash;

function compare($a, $b)
{
	if ($a == $b) {
		return 0;
	}
	elseif ($a > $b) {
		return +1;
	}
	else {
		return -1;
	}
}
