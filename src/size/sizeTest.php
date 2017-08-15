<?php

class sizeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\size($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				0
			),
			'With an empty object' => array(
				(object) [],
				0
			),
			'With an empty Countable' => array(
				new ArrayObject([]),
				0
			),
			'With a non-empty array' => array(
				array(1, 2, 3),
				3
			),
			'With a non-empty object' => array(
				(object) array('a' => 1, 'b' => 2, 'c' => 3),
				3
			),
			'With a non-empty Countable' => array(
				new ArrayObject(array(1, 2, 3)),
				3
			),
		);
	}
}
