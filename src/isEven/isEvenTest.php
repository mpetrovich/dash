<?php

/**
 * @covers Dash\isEven
 */
class isEvenTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIsEven
	 */
	public function testStandaloneIsEven($value, $expected)
	{
		$this->assertSame($expected, Dash\isEven($value));
	}

	public function casesForIsEven()
	{
		return [
			'should return true for an even integer' => [
				4,
				true
			],
			'should return true for an even double' => [
				4.7,
				true
			],
			'should return false for an odd integer' => [
				3,
				false
			],
		];
	}
}
