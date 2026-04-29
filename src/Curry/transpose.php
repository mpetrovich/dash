<?php

namespace Dash\Curry;

function transpose(/* $iterable */)
{
	return \Dash\currify(
		function ($iterable) {
			return \Dash\unzip($iterable);
		},
		func_get_args()
	);
}
