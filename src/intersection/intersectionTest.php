<?php

/**
 * @covers Dash\intersection
 * @covers Dash\intersect
 */
class intersectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable1, $iterable2, $iterable3, $expected)
	{
		$this->assertEquals($expected, Dash\intersection($iterable1, $iterable2, $iterable3));
		$this->assertEquals($expected, Dash\intersect($iterable1, $iterable2, $iterable3));
	}

	public function cases()
	{
		return [
			'With empty arrays' => [
				[],
				[],
				[],
				[]
			],
			'With non-intersecting arrays' => [
				[6, 5],
				[1, 2],
				[3, 4],
				[]
			],
			'With partially intersecting arrays' => [
				[4, 1, 6, 2],
				[1, 2, 3, 7],
				[1, 3, 5, 2],
				[1 => 1, 3 => 2]
			],
			'With partially intersecting arrays' => [
				['a' => 1, 'b' => 2, 'c' => 3],
				['x' => 2, 'y' => 4, 'z' => 3],
				['m' => 3, 'n' => 2],
				['b' => 2, 'c' => 3]
			],
			'With fully overlapping arrays' => [
				[1, 2],
				[2, 1],
				[2, 1],
				[1, 2]
			],
			'With ArrayObject instances' => [
				new ArrayObject([4, 1, 6, 2]),
				new ArrayObject([1, 2, 3, 7]),
				new ArrayObject([1, 3, 5, 2]),
				[1 => 1, 3 => 2]
			],
			'With stdClass instances' => [
				(object) ['d' => 4, 'a' => 1, 'f' => 6, 'b' => 2],
				(object) ['x' => 1, 'y' => 2, 'z' => 3],
				(object) ['m' => 1, 'o' => 3, 'q' => 5, 'n' => 2],
				['a' => 1, 'b' => 2]
			],
		];
	}
}
