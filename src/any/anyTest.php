<?php

class anyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $predicate, $expected)
	{
		$actual = Dash\any($collection, $predicate);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(

			/*
				With array
			 */

			'should return false for an empty array' => array(
				[],
				function($value, $key) {
					return $value < 0;
				},
				false
			),
			'should return false for an array with no items that satisfy the predicate' => array(
				array(1, 2, 3, 4),
				function($value) {
					return $value < 0;
				},
				false
			),
			'should return true for an array with one item that satisfies the predicate' => array(
				array(1, 2, -3, 4),
				function($value) {
					return $value < 0;
				},
				true
			),
			'should return true for an array with all items that satisfy the predicate' => array(
				array(-1, -2, -3, -4),
				function($value) {
					return $value < 0;
				},
				true
			),

			/*
				With stdClass
			 */

			'should return false for an empty stdClass' => array(
				(object) [],
				function($value, $key) {
					return $value < 0;
				},
				false
			),
			'should return false for an stdClass with no items that satisfy the predicate' => array(
				(object) array(1, 2, 3, 4),
				function($value) {
					return $value < 0;
				},
				false
			),
			'should return true for an stdClass with one item that satisfies the predicate' => array(
				(object) array(1, 2, -3, 4),
				function($value) {
					return $value < 0;
				},
				true
			),
			'should return true for an stdClass with all items that satisfy the predicate' => array(
				(object) array(-1, -2, -3, -4),
				function($value) {
					return $value < 0;
				},
				true
			),

			/*
				With ArrayObject
			 */

			'should return false for an empty ArrayObject' => array(
				new ArrayObject([]),
				function($value, $key) {
					return $value < 0;
				},
				false
			),
			'should return false for an ArrayObject with no items that satisfy the predicate' => array(
				new ArrayObject(array(1, 2, 3, 4)),
				function($value) {
					return $value < 0;
				},
				false
			),
			'should return true for an ArrayObject with one item that satisfies the predicate' => array(
				new ArrayObject(array(1, 2, -3, 4)),
				function($value) {
					return $value < 0;
				},
				true
			),
			'should return true for an ArrayObject with all items that satisfy the predicate' => array(
				new ArrayObject(array(-1, -2, -3, -4)),
				function($value) {
					return $value < 0;
				},
				true
			),
		);
	}
}
