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
			'With null' => [
				null,
				null
			],
			'With a zero number' => [
				0.0,
				null
			],
			'With a number' => [
				3.14,
				null
			],
			'With an empty string' => [
				'',
				0
			],
			'With a string' => [
				'hello',
				5
			],
			'With a multibyte string' => [
				'Björk',
				5
			],
			'With an empty array' => [
				[],
				0
			],
			'With an array' => array(
				[1, 2, 3],
				3
			),
			'With an empty object' => array(
				(object) [],
				0
			),
			'With an object' => array(
				(object) ['a' => 1, 'b' => 2, 'c' => 3],
				3
			),
			'With an empty ArrayObject' => array(
				new ArrayObject([]),
				0
			),
			'With an ArrayObject' => array(
				new ArrayObject(array(1, 2, 3)),
				3
			),
		);
	}
}
