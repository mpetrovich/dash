<?php

/**
 * @covers Dash\min
 */
class minTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\min($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(

			/*
				With array
			 */

			'should return null for an empty array' => array(
				[],
				null
			),
			'should return the min of the values of an array' => array(
				array(3, 8, 2, 5),
				2
			),

			/*
				With stdClass
			 */

			'should return null for an empty stdClass' => array(
				(object) [],
				null
			),
			'should return the min of the values of an stdClass' => array(
				(object) array(3, 8, 2, 5),
				2
			),

			/*
				With ArrayObject
			 */

			'should return null for an empty ArrayObject' => array(
				new ArrayObject([]),
				null
			),
			'should return the min of the values of an ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				2
			),
		);
	}
}
