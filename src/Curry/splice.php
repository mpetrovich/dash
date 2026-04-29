<?php

namespace Dash\Curry;

function splice(/* $offset, $length, $replacement, $iterable */)
{
	return \Dash\currify('Dash\splice', func_get_args());
}
