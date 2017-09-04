<?php

/**
 * @covers Dash\deltas
 */
class deltasTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\deltas($iterable));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				[]
			],
			'With an array of one' => [
				[3],
				[0]
			],
			'With an array' => [
				[3, 8, 9, 9, 5, 13],
				[0, 5, 1, 0, -4, 8]
			],
			'With an empty stdClass' => [
				(object) [],
				[]
			],
			'With an stdClass of one' => [
				(object) ['a' => 3],
				[0]
			],
			'With an stdClass' => [
				(object) ['a' => 3, 'b' => 8, 'c' => 9, 'd' => 9, 'e' => 5, 'f' => 13],
				[0, 5, 1, 0, -4, 8]
			],
			'With an empty ArrayObject' => [
				new ArrayObject([]),
				[]
			],
			'With an ArrayObject of one' => [
				new ArrayObject(['a' => 3]),
				[0]
			],
			'With an ArrayObject' => [
				new ArrayObject(['a' => 3, 'b' => 8, 'c' => 9, 'd' => 9, 'e' => 5, 'f' => 13]),
				[0, 5, 1, 0, -4, 8]
			],
		];
	}
}
