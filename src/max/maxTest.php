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
		$this->assertEquals($expected, Dash\max($iterable));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'should return null for an empty array' => [
				[],
				null
			],
			'should return the max of the values of an array' => [
				[3, 8, 2, 5],
				8
			],

			/*
				With stdClass
			 */

			'should return null for an empty stdClass' => [
				(object) [],
				null
			],
			'should return the max of the values of an stdClass' => [
				(object) [3, 8, 2, 5],
				8
			],

			/*
				With ArrayObject
			 */

			'should return null for an empty ArrayObject' => [
				new ArrayObject([]),
				null
			],
			'should return the max of the values of an ArrayObject' => [
				new ArrayObject([3, 8, 2, 5]),
				8
			],
		];
	}
}
