<?php

namespace Dash;

function first($iterable)
{
	return isset($iterable[0]) ? $iterable[0] : null;
}
