<?php

namespace Dash;

function thru($collection, $interceptor)
{
	return call_user_func($interceptor, $collection);
}
