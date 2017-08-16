<?php

/**
 * @covers Dash\equal
 */
class equalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$actual = Dash\equal($a, $b);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return array(
			'should return true when the values are identical' => array(
				3,
				3,
				true
			),
			'should return true when the values are equal but not identical' => array(
				'3',
				3,
				true
			),
			'should return false when the values are not equal' => array(
				'4',
				3,
				false
			),
		);
	}
}
