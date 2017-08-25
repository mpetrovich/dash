<?php

/**
 * @covers Dash\takeRight
 */
class takeRightTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertEquals($expected, Dash\takeRight($iterable, $count));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'input' => [],
				'count' => 3,
				'expected' => [],
			],
			'With an indexed array' => [
				'input' => ['a', 'b', 'c', 'd', 'e'],
				'count' => 3,
				'expected' => ['c', 'd', 'e'],
			],
			'With an associative array' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four', 'e' => 'five'],
				'count' => 3,
				'expected' => ['c' => 'three', 'd' => 'four', 'e' => 'five'],
			],
			'With an associative array and a negative count' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four', 'e' => 'five'],
				'count' => -2,
				'expected' => ['c' => 'three', 'd' => 'four', 'e' => 'five'],
			],
		];
	}
}
