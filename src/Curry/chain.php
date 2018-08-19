<?php

namespace Dash\Curry;

function chain(/* $input */)
{
	return \Dash\currify('Dash\chain', func_get_args());
}
