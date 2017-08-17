<?php

/**
 * @covers Dash\take
 */
class takeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $fromStart, $expected)
	{
		$actual = Dash\take($iterable, $count, $fromStart);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [
			'With an empty array and a zero start offset' => [
				[],
				3,
				0,
				[]
			],
			'With an empty array and a non-zero start offset' => [
				[],
				3,
				2,
				[]
			],
			'With an indexed array and a zero start offset' => [
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'],
				3,
				0,
				[0 => 'a', 1 => 'b', 2 => 'c']
			],
			'With an indexed array and a non-zero start offset' => [
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'],
				3,
				2,
				[2 => 'c', 3 => 'd', 4 => 'e'],
			],
			'With an associative array and a zero start offset' => [
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'],
				3,
				0,
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c']
			],
			'With an associative array and a non-zero start offset' => [
				['1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'],
				3,
				2,
				['3rd' => 'c', '4th' => 'd', '5th' => 'e']
			],
		];
	}
}
