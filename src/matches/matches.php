<?php

namespace Dash;

function matches($properties)
{
	$matches = function($value) use ($properties) {
		foreach ($properties as $propertyName => $propertyValue) {
			if (get($value, $propertyName) != $propertyValue) {
				return false;
			}
		}

		return true;
	};

	return $matches;
}
