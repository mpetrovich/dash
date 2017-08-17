<?php

/**
 * @covers Dash\intersection
 */
class intersectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$actual = Dash\intersection($iterable1, $iterable2, $iterable3);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With empty arrays' => array(
				[
					[],
					[],
					[],
				],
				[]
			),
			'With non-intersecting arrays' => array(
				array(
					[6, 5],
					[1, 2],
					[3, 4],
				),
				[]
			),
			'With partially intersecting arrays' => array(
				array(
					[4, 1, 2],
					[1, 2, 3],
					[1, 3, 5],
				),
				[1]
			),
			'With fully overlapping arrays' => array(
				array(
					[1, 2],
					[2, 1],
					[2, 1],
				),
				[1, 2]
			),
		);
	}

	public function testIntersectionWithSingleArray()
	{
		$iterables = array(
			[4, 1, 2],
			[1, 2, 3],
			[1, 3, 5],
		);
		$expected = [1];
		$actual = Dash\intersection($iterables);

		$this->assertEquals($expected, $actual);
	}
}
