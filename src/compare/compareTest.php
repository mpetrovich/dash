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
		$this->assertSame($expected, Dash\compare($a, $b));
	}

	public function cases()
	{
		return [
			'$a == $b' => [
				'3',
				3,
				0
			],
			'$a > $b' => [
				'4',
				3,
				+1
			],
			'$a < $b' => [
				'2',
				3,
				-1
			],
		];
	}
}
