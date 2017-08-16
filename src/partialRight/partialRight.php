<?php

namespace Dash;

function partialRight($function)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $function parameter

	$partial = function () use ($function, $fixedArgs) {
		$args = array_merge(func_get_args(), $fixedArgs);
		return call_user_func_array($function, $args);
	};
	return $partial;
}
