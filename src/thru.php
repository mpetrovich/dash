<?php

namespace Dash;

function thru(array $array, callable $interceptor)
{
	return call_user_func($interceptor, $array);
}
