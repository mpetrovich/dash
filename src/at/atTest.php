<?php

/**
 * @covers Dash\at
 */
class atTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $index, $expected)
	{
		$this->assertEquals($expected, Dash\at($iterable, $index));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'index' => 2,
				'expected' => null,
			],
			'With an indexed array' => [
				'iterable' => [2, 3, 5, 8],
				'index' => 2,
				'expected' => 5,
			],
			'With an indexed array but an invalid index' => [
				'iterable' => [2, 3, 5, 8],
				'index' => 4,
				'expected' => null,
			],
			'With an out-of-order indexed array' => [
				'iterable' => [3 => 2, 1 => 3, 0 => 5, 2 => 8],
				'index' => 2,
				'expected' => 5,
			],
			'With an associative array' => [
				'iterable' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'],
				'index' => 2,
				'expected' => 'three',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'index' => 2,
				'expected' => null,
			],
			'With an stdClass' => [
				'iterable' => (object) [2, 3, 5, 8],
				'index' => 2,
				'expected' => 5,
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'],
				'index' => 2,
				'expected' => 'three',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'index' => 2,
				'expected' => null,
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four']),
				'index' => 2,
				'expected' => 'three',
			],
		];
	}
}
