<?php

/**
 * @covers Dash\isOdd
 */
class isOddTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIsOdd
	 */
	public function testStandaloneIsOdd($value, $expected)
	{
		$this->assertSame($expected, Dash\isOdd($value));
	}

	public function casesForIsOdd()
	{
		return [
			'should return false for an even integer' => [
				4,
				false
			],
			'should return true for an odd integer' => [
				3,
				true
			],
			'should return true for an odd double' => [
				3.7,
				true
			],
		];
	}
}
