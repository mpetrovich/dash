<?php

namespace Dash\Curry;

function unzip(/* $iterable */)
{
	return \Dash\currify('Dash\unzip', func_get_args());
}
