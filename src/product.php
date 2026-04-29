<?php

namespace Dash;

/**
 * Returns the product of numeric values in `$iterable`.
 *
 * @category Math & numeric
 *
 * @param iterable|stdClass|null $iterable
 * @return numeric
 *
 * @example
	Dash\product([2, 3, 4]);
	// === 24
 */
function product($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	$product = 1;

	foreach ((array) $iterable as $value) {
		$product *= $value;
	}

	return $product;
}
