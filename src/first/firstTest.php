<?php

/**
 * @covers Dash\first
 */
class firstTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\first($iterable));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				[],
				null
			],
			'With an array' => [
				['a', 'b', 'c'],
				'a'
			],
			'With an array with null as the first element' => [
				[null, 'b', 'c'],
				null
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				(object) [],
				null
			],
			'With an stdClass' => [
				(object) ['a', 'b', 'c'],
				'a'
			],
			'With an stdClass with null as the first element' => [
				(object) [null, 'b', 'c'],
				null
			],

			/*
				With ArrayObject
			 */

			'With an empty array' => [
				new ArrayObject([]),
				null
			],
			'With an array' => [
				new ArrayObject(['a', 'b', 'c']),
				'a'
			],
			'With an array with null as the first element' => [
				new ArrayObject([null, 'b', 'c']),
				null
			],
		];
	}
}
