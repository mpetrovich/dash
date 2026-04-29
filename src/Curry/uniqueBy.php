<?php

namespace Dash\Curry;

function uniqueBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\uniqueBy', func_get_args());
}

function uniqBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\uniqueBy', func_get_args());
}

function distinctBy(/* $iteratee, $iterable */)
{
	return \Dash\currify('Dash\uniqueBy', func_get_args());
}
