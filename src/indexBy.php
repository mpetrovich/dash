<?php

namespace Dash;

function indexBy($input, $indexBy = 'Dash\identity')
{
	return keyBy($input, $indexBy);
}
