<?php

/**
 * @covers Dash\difference
 * @covers Dash\diff
 */
class differenceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$this->assertEquals($expected, Dash\difference($iterable1, $iterable2, $iterable3));
		$this->assertEquals($expected, Dash\diff($iterable1, $iterable2, $iterable3));
	}

	public function cases()
	{
		return [
			'With empty iterables' => [
				[
					[],
					(object) [],
					new ArrayObject([]),
				],
				[]
			],
			'With non-intersecting iterables' => [
				[
					[6, 5],
					(object) [1, 2],
					new ArrayObject([3, 4]),
				],
				[6, 5]
			],
			'With an indexed array and partially intersecting iterables' => [
				[
					[4, 2, 1, 6],
					(object) [3, 4, 5],
					new ArrayObject([1, 3, 5]),
				],
				[1 => 2, 3 => 6]
			],
			'With an associative array and partially intersecting iterables' => [
				[
					['a' => 4, 'b' => 2, 'c' => 1],
					(object) [3, 4, 5],
					new ArrayObject([1, 3, 5]),
				],
				['b' => 2]
			],
			'With fully overlapping iterables' => [
				[
					[1, 2],
					(object) [2, 1],
					new ArrayObject([2, 1]),
				],
				[]
			],
		];
	}
}
