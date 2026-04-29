<?php

namespace Dash\Curry;

function flattenDepth(/* $depth, $iterable */)
{
	return \Dash\currify('Dash\flattenDepth', func_get_args());
}
