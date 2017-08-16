<?php

/**
 * @covers Dash\keys
 */
class keysTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\keys($iterable);
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
			'should return the integer keys from an indexed array' => array(
				array(3, 8, 2, 5),
				array(0, 1, 2, 3)
			),
			'should return the keys from an associative array' => array(
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('a', 'b', 'c', 'd')
			),

			/*
				With stdClass
			 */

			'should return an empty array from an empty stdClass' => array(
				(object) [],
				[]
			),
			'should return the keys from an stdClass' => array(
				(object) array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('a', 'b', 'c', 'd')
			),

			/*
				With ArrayObject
			 */

			'should return an empty array from an empty ArrayObject' => array(
				new ArrayObject([]),
				[]
			),
			'should return the keys from an ArrayObject' => array(
				new ArrayObject(array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5)),
				array('a', 'b', 'c', 'd')
			),
		);
	}
}
