<?php

namespace Dash\Curry;

function evolve(/* $transformations, $input */)
{
	return \Dash\currify('Dash\evolve', func_get_args());
}
