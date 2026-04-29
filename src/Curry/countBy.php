<?php

namespace Dash\Curry;

function countBy(/* $iteratee, $defaultGroup, $iterable */)
{
	return \Dash\currify('Dash\countBy', func_get_args());
}
