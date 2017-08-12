<?php

use Dash\_;

class atTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForAt
	 */
	public function testStandaloneAt($collection, $index, $expected)
	{
		$actual = Dash\at($collection, $index);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForAt
	 */
	public function testChainedAt($collection, $index, $expected)
	{
		$actual = _::chain($collection)->at($index)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForAt()
	{
		return array(

			/*
				With array
			 */

			'should return null for an empty array' => array(
				[],
				2,
				null
			),
			'should return the value at the given index of an indexed array' => array(
				array(2, 3, 5, 8),
				2,
				5
			),
			'should return the value at the given Nth item of an associative array' => array(
				array(3 => 2, 1 => 3, 0 => 5, 2 => 8),
				2,
				5
			),

			/*
				With stdClass
			 */

			'should return null for an empty stdClass' => array(
				(object) [],
				2,
				null
			),
			'should return the value at the given index of an stdClass' => array(
				(object) array(2, 3, 5, 8),
				2,
				5
			),

			/*
				With ArrayObject
			 */

			'should return null for an empty ArrayObject' => array(
				new ArrayObject([]),
				2,
				null
			),
			'should return the value at the given index of an ArrayObject' => array(
				new ArrayObject(array(2, 3, 5, 8)),
				2,
				5
			),
		);
	}
}
