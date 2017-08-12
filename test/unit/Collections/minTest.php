<?php

use Dash\Container;

class minTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMin
	 */
	public function testStandaloneMin($collection, $expected)
	{
		$actual = Dash\min($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForMin
	 */
	public function testChainedMin($collection, $expected)
	{
		$container = new Container($collection);
		$actual = $container->min()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMin()
	{
		return array(

			/*
				With array
			 */

			'should return null for an empty array' => array(
				array(),
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
				(object) array(),
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
				new ArrayObject(array()),
				null
			),
			'should return the min of the values of an ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				2
			),
		);
	}
}
