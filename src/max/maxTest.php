<?php

/**
 * @covers Dash\max
 */
class maxTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\max($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(

			/*
				With array
			 */

			'should return null for an empty array' => [
				[],
				null
			],
			'should return the max of the values of an array' => array(
				[3, 8, 2, 5],
				8
			),

			/*
				With stdClass
			 */

			'should return null for an empty stdClass' => array(
				(object) [],
				null
			),
			'should return the max of the values of an stdClass' => array(
				(object) [3, 8, 2, 5],
				8
			),

			/*
				With ArrayObject
			 */

			'should return null for an empty ArrayObject' => array(
				new ArrayObject([]),
				null
			),
			'should return the max of the values of an ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				8
			),
		);
	}
}
