<?php

use Dash\Container;

class isOddTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIsOdd
	 */
	public function testStandaloneIsOdd($value, $expected)
	{
		$actual = Dash\isOdd($value);
		$this->assertSame($expected, $actual);
	}

	public function casesForIsOdd()
	{
		return array(
			'should return false for an even value' => array(
				4,
				false
			),
			'should return true for an odd value' => array(
				3,
				true
			),
		);
	}
}
