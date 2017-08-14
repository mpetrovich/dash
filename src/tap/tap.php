<?php

namespace Dash;

function tap($array, callable $interceptor)
{
	call_user_func($interceptor, $array);
	return $array;
}
