<?php

/**
 * @covers Dash\last
 */
class lastTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\last($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => [
				[],
				null
			],
			'With an array' => array(
				['a', 'b', 'c'],
				'c'
			),
			'With an array with null as the last element' => array(
				['a', 'b', null],
				null
			),
		);
	}
}
