<?php

namespace Dash\Generator;

/**
 * @see Dash\findWhere()
 */
// @codingStandardsIgnoreLine
function findWhere($iterable, $properties)
{
	yield from filter($iterable, \Dash\matches($properties));
}
