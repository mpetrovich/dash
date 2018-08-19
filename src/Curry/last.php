<?php

namespace Dash\Curry;

function last(/* $iterable */)
{
	return \Dash\currify('Dash\last', func_get_args());
}
