<?php

class differenceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$actual = Dash\difference($iterable1, $iterable2, $iterable3);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With empty arrays' => array(
				array(
					[],
					[],
					[],
				),
				[]
			),
			'With non-intersecting arrays' => array(
				array(
					array(6, 5),
					array(1, 2),
					array(3, 4),
				),
				array(6, 5, 1, 2, 3, 4)
			),
			'With partially intersecting arrays' => array(
				array(
					array(4, 1, 2),
					array(1, 2, 3),
					array(1, 3, 5),
				),
				array(4, 2, 3, 5)
			),
			'With fully overlapping arrays' => array(
				array(
					array(1, 2),
					array(2, 1),
					array(2, 1),
				),
				[]
			),
		);
	}
}
