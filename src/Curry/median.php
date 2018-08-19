<?php

namespace Dash\Curry;

function median(/* $iterable */)
{
	return \Dash\currify('Dash\median', func_get_args());
}
