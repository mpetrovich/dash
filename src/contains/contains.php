<?php

namespace Dash;

function contains($iterable, $target, $predicate = 'Dash\equal')
{
	return any($iterable, partial($predicate, $target));
}
