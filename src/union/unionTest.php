<?php

/**
 * @covers Dash\union
 */
class unionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$actual = Dash\union($iterable1, $iterable2, $iterable3);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [
			'With empty arrays' => [
				[
					[],
					[],
					[],
				],
				[]
			],
			'With non-intersecting arrays' => [
				[
					[6, 5],
					[1, 2],
					[3, 4],
				],
				[6, 5, 1, 2, 3, 4]
			],
			'With partially intersecting arrays' => [
				[
					[4, 1, 2],
					[1, 2, 3],
					[1, 3, 5],
				],
				[4, 1, 2, 3, 5]
			],
			'With fully overlapping arrays' => [
				[
					[1, 2],
					[2, 1],
					[2, 1],
				],
				[1, 2]
			],
		];
	}

	public function testUnionWithSingleArray()
	{
		$iterables = [
			[4, 1, 2],
			[1, 2, 3],
			[1, 3, 5],
		];
		$expected = [4, 1, 2, 3, 5];
		$actual = Dash\union($iterables);

		$this->assertEquals($expected, $actual);
	}
}
