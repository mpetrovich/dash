<?php

/**
 * @covers Dash\first
 */
class firstTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\first($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				null
			),
			'With a non-empty array' => array(
				array('a', 'b', 'c'),
				'a'
			),
			'With a non-empty array with null as the first element' => array(
				array(null, 'b', 'c'),
				null
			),
		);
	}
}
