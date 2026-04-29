<?php

namespace Dash\Curry;

function times(/* $iteratee, $n */)
{
	return \Dash\currify('Dash\times', func_get_args());
}
