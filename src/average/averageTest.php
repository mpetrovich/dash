<?php

/**
 * @covers Dash\average
 */
class averageTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\average($iterable));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				[],
				0
			],
			'With an array' => [
				[2, 3, 5, 8],
				4.5
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				(object) [],
				0
			],
			'With an stdClass' => [
				(object) [2, 3, 5, 8],
				4.5
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				new ArrayObject([]),
				0
			],
			'With an ArrayObject' => [
				new ArrayObject([2, 3, 5, 8]),
				4.5
			],
		];
	}
}
