<?php

use Dash\_;

class medianTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMedian
	 */
	public function testStandaloneMedian($collection, $expected)
	{
		$actual = Dash\median($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForMedian
	 */
	public function testChainedMedian($collection, $expected)
	{
		$container = new _($collection);
		$actual = $container->median()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMedian()
	{
		return array(

			/*
				With array
			 */

			'should return zero for an empty array' => array(
				array(),
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
				(object) array(),
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
				new ArrayObject(array()),
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
