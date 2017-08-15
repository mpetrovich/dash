<?php

class deltasTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $expected)
	{
		$actual = Dash\deltas($collection);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				[]
			),
			'With a non-empty array' => array(
				array(3, 8, 9, 9, 5, 13),
				array(0, 5, 1, 0, -4, 8)
			),
		);
	}
}
