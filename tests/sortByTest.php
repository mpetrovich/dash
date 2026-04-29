<?php

/**
 * @covers Dash\sortBy
 * @covers Dash\Curry\sortBy
 */
class sortByTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $iteratee, $expected)
	{
		$this->assertEquals($expected, Dash\sortBy($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $iteratee, $expected)
	{
		$s = Dash\Curry\sortBy($iteratee);
		$this->assertEquals($expected, $s($iterable));
	}

	public function testStableWhenSortKeysEqual()
	{
		$rows = [['tag' => 1, 'id' => 'a'], ['tag' => 1, 'id' => 'b'], ['tag' => 1, 'id' => 'c']];
		$this->assertEquals($rows, Dash\sortBy($rows, 'tag'));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'iteratee' => 'Dash\identity',
				'expected' => [],
			],
			'With indexed numbers' => [
				'iterable' => [4, 3, 5, 1, 2],
				'iteratee' => 'Dash\identity',
				'expected' => [1, 2, 3, 4, 5],
			],
			'With path on rows' => [
				'iterable' => [['x' => 2], ['x' => 1], ['x' => 3]],
				'iteratee' => 'x',
				'expected' => [['x' => 1], ['x' => 2], ['x' => 3]],
			],
			'With associative preserve keys' => [
				'iterable' => ['a' => 3, 'b' => 1, 'c' => 2],
				'iteratee' => 'Dash\identity',
				'expected' => ['b' => 1, 'c' => 2, 'a' => 3],
			],
		];
	}
}
