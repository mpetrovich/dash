<?php

namespace Dash\Curry;

function shuffle(/* $iterable */)
{
	return \Dash\currify('Dash\shuffle', func_get_args());
}
