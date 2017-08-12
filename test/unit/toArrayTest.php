<?php

use Dash\_;

class toArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForToArray
	 */
	public function testStandaloneToArray($collection, $expected)
	{
		$actual = Dash\toArray($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForToArray
	 */
	public function testChainedToArray($collection, $expected)
	{
		$_ = new _($collection);
		$actual = $_->toArray()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForToArray()
	{
		return array(

			/*
				With array
			 */

			'should return an empty array for an empty array' => array(
				array(),
				array(),
			),
			'should return an array of the values of an indexed array' => array(
				array(3, 8, 2, 5),
				array(3, 8, 2, 5),
			),
			'should return an array of the values of an associative array' => array(
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
			),

			/*
				With stdClass
			 */

			'should return an empty array for an empty stdClass' => array(
				(object) array(),
				array(),
			),
			'should return an array of the values of a stdClass' => array(
				(object) array(3, 8, 2, 5),
				array(3, 8, 2, 5),
			),
			'should return an array of the values of an associative array' => array(
				(object) array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
			),

			/*
				With ArrayObject
			 */

			'should return an empty array for an empty ArrayObject' => array(
				new ArrayObject(array()),
				array(),
			),
			'should return an array of the values of an indexed ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				array(3, 8, 2, 5),
			),
			'should return an array of the values of an associative ArrayObject' => array(
				new ArrayObject(array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5)),
				array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5),
			),
		);
	}
}
