<?php

/**
 * @covers Dash\deltas
 */
class deltasTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\deltas($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => [
				[],
				[]
			],
			'With an array' => array(
				[3, 8, 9, 9, 5, 13],
				[0, 5, 1, 0, -4, 8]
			),
		);
	}
}
