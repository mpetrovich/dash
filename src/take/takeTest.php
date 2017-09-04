<?php

/**
 * @covers Dash\take
 */
class takeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertSame($expected, Dash\take($iterable, $count));
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
				'expected' => ['a', 'b', 'c'],
			],
			'With an associative array' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four', 'e' => 'five'],
				'count' => 3,
				'expected' => ['a' => 'one', 'b' => 'two', 'c' => 'three'],
			],
			'With an associative array and a negative count' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four', 'e' => 'five'],
				'count' => -2,
				'expected' => ['a' => 'one', 'b' => 'two', 'c' => 'three'],
			],
		];
	}
}
