<?php

/**
 * @covers Dash\compare
 */
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
			'should return zero when the values are equal' => [
				'3',
				3,
				0
			],
			'should return +1 when the first value is greater than the second' => [
				'4',
				3,
				+1
			],
			'should return -1 when the first value is less than the second' => [
				'2',
				3,
				-1
			],
		);
	}
}
