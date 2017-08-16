<?php

/**
 * @covers Dash\size
 */
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
			'With null' => array(
				null,
				null
			),
			'With a zero number' => array(
				0.0,
				null
			),
			'With a non-zero number' => array(
				3.14,
				null
			),
			'With an empty string' => array(
				'',
				0
			),
			'With a non-empty string' => array(
				'hello',
				5
			),
			'With a multibyte string' => array(
				'Björk',
				5
			),
			'With an empty array' => array(
				[],
				0
			),
			'With a non-empty array' => array(
				array(1, 2, 3),
				3
			),
			'With an empty object' => array(
				(object) [],
				0
			),
			'With a non-empty object' => array(
				(object) array('a' => 1, 'b' => 2, 'c' => 3),
				3
			),
			'With an empty ArrayObject' => array(
				new ArrayObject([]),
				0
			),
			'With a non-empty ArrayObject' => array(
				new ArrayObject(array(1, 2, 3)),
				3
			),
		);
	}
}
