<?php

/**
 * @covers Dash\at
 */
class atTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $index, $expected)
	{
		$this->assertEquals($expected, Dash\at($iterable, $index));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				[],
				2,
				null
			],
			'With an indexed array' => [
				[2, 3, 5, 8],
				2,
				5
			],
			'With an associative array' => [
				[3 => 2, 1 => 3, 0 => 5, 2 => 8],
				2,
				5
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				(object) [],
				2,
				null
			],
			'With an stdClass' => [
				(object) [2, 3, 5, 8],
				2,
				5
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				new ArrayObject([]),
				2,
				null
			],
			'With an ArrayObject' => [
				new ArrayObject([2, 3, 5, 8]),
				2,
				5
			],
		];
	}
}
