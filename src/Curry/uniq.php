<?php

namespace Dash\Curry;

function uniq(/* $iterable */)
{
	return \Dash\currify('Dash\unique', func_get_args());
}
