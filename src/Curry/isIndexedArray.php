<?php

namespace Dash\Curry;

function isIndexedArray(/* $value */)
{
	return \Dash\currify('Dash\isIndexedArray', func_get_args());
}
