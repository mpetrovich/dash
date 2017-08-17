<?php

/**
 * @covers Dash\takeRight
 */
class takeRightTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $fromEnd, $expected)
	{
		$actual = Dash\takeRight($iterable, $count, $fromEnd);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array and a zero end offset' => [
				[],
				3,
				0,
				[]
			],
			'With an empty array and a non-zero end offset' => [
				[],
				3,
				2,
				[]
			],
			'With an indexed array and a zero end offset' => array(
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'],
				3,
				0,
				[2 => 'c', 3 => 'd', 4 => 'e']
			),
			'With an indexed array and a non-zero end offset' => array(
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'],
				3,
				2,
				[0 => 'a', 1 => 'b', 2 => 'c'],
			),
			'With an associative array and a zero end offset' => array(
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'],
				3,
				0,
				['3rd' => 'c', '4th' => 'd', '5th' => 'e']
			),
			'With an associative array and a non-zero end offset' => array(
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'],
				3,
				2,
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c']
			),
		);
	}
}
