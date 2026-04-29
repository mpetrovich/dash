<?php

namespace Dash\Curry;

function zipWith(/* $combiner, $iterable1, $iterable2 */)
{
	return \Dash\currify(
		function ($iterable1, $iterable2, callable $combiner) {
			return \Dash\zipWith($iterable1, $iterable2, $combiner);
		},
		func_get_args(),
		2
	);
}
