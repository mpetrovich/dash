<?php

/**
 * @covers Dash\every
 */
class everyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForEvery
	 */
	public function testStandaloneEvery($iterable, $predicate, $expected)
	{
		$actual = Dash\every($iterable, $predicate);
		$this->assertEquals($expected, $actual);
	}

	public function casesForEvery()
	{
		return [

			/*
				With array
			 */

			'should return true for an empty array' => [
				[],
				function ($value, $key) {
					return $value < 0;
				},
				true
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
				false
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

			'should return true for an empty stdClass' => [
				(object) [],
				function ($value, $key) {
					return $value < 0;
				},
				true
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
				false
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

			'should return true for an empty ArrayObject' => [
				new ArrayObject([]),
				function ($value, $key) {
					return $value < 0;
				},
				true
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
				false
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
