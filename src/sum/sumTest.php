<?php

/**
 * @covers Dash\sum
 * @covers Dash\_sum
 */
class sumTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\sum($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$sum = Dash\_sum();
		$this->assertEquals($expected, $sum($iterable));
	}

	public function cases()
	{
		return [

			'With an empty array' => [
				[],
				0
			],
			'With an array' => [
				[2, 3, 5, 8],
				18
			],

			'With an empty stdClass' => [
				(object) [],
				0
			],
			'With an stdClass' => [
				(object) [2, 3, 5, 8],
				18
			],

			'With an empty ArrayObject' => [
				new ArrayObject([]),
				0
			],
			'With an ArrayObject' => [
				new ArrayObject([2, 3, 5, 8]),
				18
			],
		];
	}
}
