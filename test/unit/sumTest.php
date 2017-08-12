<?php

use Dash\_;

class sumTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForSum
	 */
	public function testStandaloneSum($collection, $expected)
	{
		$actual = Dash\sum($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForSum
	 */
	public function testChainedSum($collection, $expected)
	{
		$actual = _::chain($collection)->sum()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForSum()
	{
		return array(

			/*
				With array
			 */

			'should return zero for an empty array' => array(
				[],
				0
			),
			'should return the sum of the values of an array' => array(
				array(2, 3, 5, 8),
				18
			),

			/*
				With stdClass
			 */

			'should return zero for an empty stdClass' => array(
				(object) [],
				0
			),
			'should return the sum of the values of an stdClass' => array(
				(object) array(2, 3, 5, 8),
				18
			),

			/*
				With ArrayObject
			 */

			'should return zero for an empty ArrayObject' => array(
				new ArrayObject([]),
				0
			),
			'should return the sum of the values of an ArrayObject' => array(
				new ArrayObject(array(2, 3, 5, 8)),
				18
			),
		);
	}
}
