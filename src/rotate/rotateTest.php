<?php

/**
 * @covers Dash\rotate
 * @covers Dash\_rotate
 */
class rotateTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertEquals($expected, Dash\rotate($iterable, $count));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $count, $expected)
	{
		$rotate = Dash\_rotate($count);
		$this->assertEquals($expected, $rotate($iterable));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'count' => 1,
				'expected' => [],
			],
			'With an array and a zero count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 0,
				'expected' => [1, 2, 3, 4],
			],

			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 1,
				'expected' => [2, 3, 4, 1],
			],
			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 2,
				'expected' => [3, 4, 1, 2],
			],
			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 3,
				'expected' => [4, 1, 2, 3],
			],
			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 5,
				'expected' => [2, 3, 4, 1],
			],
			'With an array and a positive count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => 6,
				'expected' => [3, 4, 1, 2],
			],

			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -1,
				'expected' => [4, 1, 2, 3],
			],
			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -2,
				'expected' => [3, 4, 1, 2],
			],
			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -3,
				'expected' => [2, 3, 4, 1],
			],
			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -4,
				'expected' => [1, 2, 3, 4],
			],
			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -5,
				'expected' => [4, 1, 2, 3],
			],
			'With an array and a negative count' => [
				'iterable' => [1, 2, 3, 4],
				'count' => -6,
				'expected' => [3, 4, 1, 2],
			],
		];
	}
}
