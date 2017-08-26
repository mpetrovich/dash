<?php

/**
 * @covers Dash\without
 */
class withoutTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $without, $expected)
	{
		$this->assertEquals($expected, Dash\without($iterable, $without));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'without' => [],
				'expected' => [],
			],
			'With no matching exclusions' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'without' => ['e', 'f'],
				'expected' => ['a', 'b', 'c', 'd'],
			],
			'With some matching exclusions' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'without' => ['c', 'd', 'e'],
				'expected' => ['a', 'b'],
			],
			'With some matching exclusions' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'without' => ['c' => 3, 'd' => 4, 'e' => 5],
				'expected' => ['a' => 1, 'b' => 2],
			],
			'With everything excluded' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'without' => ['a', 'b', 'c', 'd'],
				'expected' => [],
			],
		];
	}
}
