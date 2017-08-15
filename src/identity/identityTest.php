<?php

class identityTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$actual = Dash\identity($value);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				[]
			),
			'With a non-empty array' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e')
			),
			'With a scalar value' => array(
				'abc',
				'abc'
			)
		);
	}
}
