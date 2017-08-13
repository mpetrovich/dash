<?php

use Dash\_;

class setTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $field, $value, $expected)
	{
		$this->assertEquals($expected, Dash\set($input, $field, $value));
	}

	public function cases()
	{
		return [
		];
	}
}

