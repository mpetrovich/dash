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
		$actual = Dash\any($iterable, $predicate);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'should return false for an empty array' => [
				[],
				function ($value, $key) {
					return $value < 0;
				},
				false
			],
			'should return false for an array with no items that satisfy the predicate' => [
				[1, 2, 3, 4],
				function ($value) {
					return $value < 0;
				},
				false
			],
			'should return true for an array with one item that satisfies the predicate' => [
				[1, 2, -3, 4],
				function ($value) {
					return $value < 0;
				},
				true
			],
			'should return true for an array with all items that satisfy the predicate' => [
				[-1, -2, -3, -4],
				function ($value) {
					return $value < 0;
				},
				true
			],

			/*
				With stdClass
			 */

			'should return false for an empty stdClass' => [
				(object) [],
				function ($value, $key) {
					return $value < 0;
				},
				false
			],
			'should return false for an stdClass with no items that satisfy the predicate' => [
				(object) [1, 2, 3, 4],
				function ($value) {
					return $value < 0;
				},
				false
			],
			'should return true for an stdClass with one item that satisfies the predicate' => [
				(object) [1, 2, -3, 4],
				function ($value) {
					return $value < 0;
				},
				true
			],
			'should return true for an stdClass with all items that satisfy the predicate' => [
				(object) [-1, -2, -3, -4],
				function ($value) {
					return $value < 0;
				},
				true
			],

			/*
				With ArrayObject
			 */

			'should return false for an empty ArrayObject' => [
				new ArrayObject([]),
				function ($value, $key) {
					return $value < 0;
				},
				false
			],
			'should return false for an ArrayObject with no items that satisfy the predicate' => [
				new ArrayObject([1, 2, 3, 4]),
				function ($value) {
					return $value < 0;
				},
				false
			],
			'should return true for an ArrayObject with one item that satisfies the predicate' => [
				new ArrayObject([1, 2, -3, 4]),
				function ($value) {
					return $value < 0;
				},
				true
			],
			'should return true for an ArrayObject with all items that satisfy the predicate' => [
				new ArrayObject([-1, -2, -3, -4]),
				function ($value) {
					return $value < 0;
				},
				true
			],
		];
	}
}
