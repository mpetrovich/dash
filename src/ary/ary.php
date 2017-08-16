<?php

namespace Dash;

function ary($callable, $ary)
{
	return function () use ($callable, $ary) {
		$args = array_slice(func_get_args(), 0, $ary);
		return call_user_func_array($callable, $args);
	};
}
