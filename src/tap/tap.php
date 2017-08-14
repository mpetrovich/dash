<?php

namespace Dash;

function tap($iterable, callable $interceptor)
{
	call_user_func($interceptor, $iterable);
	return $iterable;
}
