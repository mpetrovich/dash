<?php

/**
 * @covers Dash\set
 */
class sortTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$original = $iterable;
		$this->assertEquals($expected, Dash\sort($iterable));
		$this->assertSame($original, $iterable, 'Original iterable should not be modified');
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
			'should return a sorted array from an indexed array' => [
				[4, 1, 3, 2],
				[1, 2, 3, 4]
			],
			'should return a sorted array from an associative array' => [
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['c' => 2, 'a' => 3, 'd' => 5, 'b' => 8]
			],

			/*
				With stdClass
			 */

			'should return an empty array from an empty stdClass' => [
				(object) [],
				[]
			],
			'should return a sorted array from an stdClass' => [
				(object) [4, 1, 3, 2],
				[1, 2, 3, 4]
			],
			'should return a sorted array from an stdClass' => [
				(object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['c' => 2, 'a' => 3, 'd' => 5, 'b' => 8]
			],

			/*
				With ArrayObject
			 */

			'should return an empty array from an empty ArrayObject' => [
				new ArrayObject([]),
				[]
			],
			'should return a sorted array from an ArrayObject' => [
				new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				['c' => 2, 'a' => 3, 'd' => 5, 'b' => 8]
			],
		];
	}

	public function testComparator()
	{
		$comparator = function ($a, $b) { return $b - $a; };
		$this->assertEquals([4, 3, 2, 1], Dash\sort([1, 2, 3, 4], $comparator));
	}
}
