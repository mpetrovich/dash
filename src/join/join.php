<?php

namespace Dash;

function join($input, $glue)
{
	return implode($glue, toArray($input));
}
