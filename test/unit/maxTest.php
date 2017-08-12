<?php

use Dash\_;

class maxTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMax
	 */
	public function testStandaloneMax($collection, $expected)
	{
		$actual = Dash\max($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForMax
	 */
	public function testChainedMax($collection, $expected)
	{
		$actual = _::chain($collection)->max()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMax()
	{
		return array(

			/*
				With array
			 */

			'should return null for an empty array' => array(
				array(),
				null
			),
			'should return the max of the values of an array' => array(
				array(3, 8, 2, 5),
				8
			),

			/*
				With stdClass
			 */

			'should return null for an empty stdClass' => array(
				(object) array(),
				null
			),
			'should return the max of the values of an stdClass' => array(
				(object) array(3, 8, 2, 5),
				8
			),

			/*
				With ArrayObject
			 */

			'should return null for an empty ArrayObject' => array(
				new ArrayObject(array()),
				null
			),
			'should return the max of the values of an ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				8
			),
		);
	}
}
