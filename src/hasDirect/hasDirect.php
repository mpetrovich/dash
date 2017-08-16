<?php

namespace Dash;

function hasDirect($subject, $field)
{
	return is_array($subject) && array_key_exists($field, $subject)
		|| is_object($subject) && property_exists($subject, $field);
}
