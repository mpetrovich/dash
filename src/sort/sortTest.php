<?php

// @todo Test that original collection is not modified
// @todo Test with comparator
class sortTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $expected)
	{
		$actual = Dash\sort($collection);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(

			/*
				With array
			 */

			'should return an empty array from an empty array' => array(
				[],
				[]
			),
			'should return a sorted array from an indexed array' => array(
				array(3, 8, 2, 5),
				array(2 => 2, 0 => 3, 3 => 5, 1 => 8)
			),
			'should return a sorted array from an associative array' => array(
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('c' => 2, 'a' => 3, 'd' => 5, 'b' => 8)
			),

			/*
				With stdClass
			 */

			'should return an empty array from an empty stdClass' => array(
				(object) [],
				[]
			),
			'should return a sorted array from an stdClass' => array(
				(object) array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('c' => 2, 'a' => 3, 'd' => 5, 'b' => 8)
			),

			/*
				With ArrayObject
			 */

			'should return an empty array from an empty ArrayObject' => array(
				new ArrayObject([]),
				[]
			),
			'should return a sorted array from an ArrayObject' => array(
				new ArrayObject(array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5)),
				array('c' => 2, 'a' => 3, 'd' => 5, 'b' => 8)
			),
		);
	}
}
