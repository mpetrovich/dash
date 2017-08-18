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
			'With an empty array' => [
				[],
				0
			],
			'With an array of one' => [
				[3],
				3
			],
			'With an array' => [
				[2, 3, 5, 8],
				4.5
			],
			'With an empty stdClass' => [
				(object) [],
				0
			],
			'With an stdClass of one' => [
				(object) ['a' => 3],
				3
			],
			'With an stdClass' => [
				(object) ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				4.5
			],
			'With an empty ArrayObject' => [
				new ArrayObject([]),
				0
			],
			'With an ArrayObject of one' => [
				new ArrayObject(['a' => 3]),
				3
			],
			'With an ArrayObject' => [
				new ArrayObject(['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8]),
				4.5
			],
		];
	}
}
