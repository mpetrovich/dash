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
		$actual = Dash\isEven($value);
		$this->assertSame($expected, $actual);
	}

	public function casesForIsEven()
	{
		return array(
			'should return true for an even value' => array(
				4,
				true
			),
			'should return false for an odd value' => array(
				3,
				false
			),
		);
	}
}
