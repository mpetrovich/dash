<?php

/**
 * @covers Dash\isIndexedArray
 */
class isIndexedArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		$this->assertEquals($expected, Dash\isIndexedArray($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				null,
				false,
			],
			'With a number' => [
				123,
				false,
			],
			'With a string' => [
				'hello',
				false,
			],
			'With an empty array' => [
				[],
				true,
			],
			'With an indexed array' => [
				[1, 2, 3],
				true,
			],
			'With an explicitly indexed array' => [
				[0 => 1, 1 => 2, 2 => 3],
				true,
			],
			'With an explicitly indexed array with keys out of order' => [
				[1 => 2, 0 => 1, 2 => 3],
				false,
			],
			'With a 1-indexed associative array' => [
				[1 => 1, 2 => 2, 3 => 3],
				false,
			],
			'With an associative array with integer-like string keys' => [
				['0' => 1, '1' => 2, '2' => 3],
				true,
			],
			'With an associative array' => [
				['a' => 1, 'b' => 2, 'c' => 3],
				false,
			],
			'With an empty stdClass' => [
				(object) [],
				false,
			],
			'With an stdClass' => [
				(object) ['a' => 1, 'b' => 2, 'c' => 3],
				false,
			],
			'With an ArrayObject' => [
				new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				false,
			],
		];
	}
}
