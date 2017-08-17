<?php

/**
 * @covers Dash\keys
 */
class keysTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\keys($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'should return an empty array from an empty array' => [
				[],
				[]
			],
			'should return the integer keys from an indexed array' => [
				[3, 8, 2, 5],
				[0, 1, 2, 3]
			],
			'should return the keys from an associative array' => [
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a', 'b', 'c', 'd']
			],

			/*
				With stdClass
			 */

			'should return an empty array from an empty stdClass' => [
				(object) [],
				[]
			],
			'should return the keys from an stdClass' => [
				(object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a', 'b', 'c', 'd']
			],

			/*
				With ArrayObject
			 */

			'should return an empty array from an empty ArrayObject' => [
				new ArrayObject([]),
				[]
			],
			'should return the keys from an ArrayObject' => [
				new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				['a', 'b', 'c', 'd']
			],
		];
	}
}
