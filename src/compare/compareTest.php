<?php

class compareTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$actual = Dash\compare($a, $b);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return array(
			'should return zero when the values are equal' => array(
				'3',
				3,
				0
			),
			'should return +1 when the first value is greater than the second' => array(
				'4',
				3,
				+1
			),
			'should return -1 when the first value is less than the second' => array(
				'2',
				3,
				-1
			),
		);
	}
}
