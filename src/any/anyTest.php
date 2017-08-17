<?php

/**
 * @covers Dash\any
 */
class anyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\any($iterable, $predicate));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'predicate' => function ($value, $key) { return $value < 0; },
				'expected' => false,
			],
			'With an array with no items that satisfy the predicate' => [
				'iterable' => [1, 2, 3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => false,
			],
			'With an array with one item that satisfies the predicate' => [
				'iterable' => [1, 2, -3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an array with several items that satisfy the predicate' => [
				'iterable' => [1, -2, -3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an array with all items that satisfy the predicate' => [
				'iterable' => [-1, -2, -3, -4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'predicate' => function ($value, $key) { return $value < 0; },
				'expected' => false,
			],
			'With an stdClass with no items that satisfy the predicate' => [
				'iterable' => (object) [1, 2, 3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => false,
			],
			'With an stdClass with one item that satisfies the predicate' => [
				'iterable' => (object) [1, 2, -3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an stdClass with several items that satisfy the predicate' => [
				'iterable' => (object) [1, -2, -3, 4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an stdClass with all items that satisfy the predicate' => [
				'iterable' => (object) [-1, -2, -3, -4],
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'predicate' => function ($value, $key) { return $value < 0; },
				'expected' => false,
			],
			'With an ArrayObject with no items that satisfy the predicate' => [
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'predicate' => function ($value) { return $value < 0; },
				'expected' => false,
			],
			'With an ArrayObject with one item that satisfies the predicate' => [
				'iterable' => new ArrayObject([1, 2, -3, 4]),
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an ArrayObject with several items that satisfy the predicate' => [
				'iterable' => new ArrayObject([1, -2, -3, 4]),
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
			'With an ArrayObject with all items that satisfy the predicate' => [
				'iterable' => new ArrayObject([-1, -2, -3, -4]),
				'predicate' => function ($value) { return $value < 0; },
				'expected' => true,
			],
		];
	}
}
