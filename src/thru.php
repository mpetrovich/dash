<?php

namespace Dash;

function thru($value, callable $interceptor)
{
	return call_user_func($interceptor, $value);
}
