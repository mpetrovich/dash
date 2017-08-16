<?php

namespace Dash;

function isEmpty($input)
{
	return empty($input) || size($input) === 0;
}
