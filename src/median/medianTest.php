<?php

class medianTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\median($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(

			/*
				With array
			 */

			'should return zero for an empty array' => array(
				[],
				0
			),
			'should return the median of the values of an array with an even number of values' => array(
				array(3, 8, 2, 5),
				4
			),
			'should return the median of the values of an array with an odd number of values' => array(
				array(3, 8, 2, 13, 5),
				5
			),

			/*
				With stdClass
			 */

			'should return zero for an empty stdClass' => array(
				(object) [],
				0
			),
			'should return the median of the values of an stdClass with an even number of values' => array(
				(object) array(3, 8, 2, 5),
				4
			),
			'should return the median of the values of an stdClass with an odd number of values' => array(
				(object) array(3, 8, 2, 13, 5),
				5
			),

			/*
				With ArrayObject
			 */

			'should return zero for an empty ArrayObject' => array(
				new ArrayObject([]),
				0
			),
			'should return the median of the values of an ArrayObject with an even number of values' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				4
			),
			'should return the median of the values of an ArrayObject with an odd number of values' => array(
				new ArrayObject(array(3, 8, 2, 13, 5)),
				5
			),
		);
	}
}
