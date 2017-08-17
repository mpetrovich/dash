<?php

/**
 * @covers Dash\identity
 */
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
			'With an empty array' => [
				[],
				[]
			],
			'With an array' => array(
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'],
				[0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e']
			),
			'With a scalar value' => [
				'abc',
				'abc'
			]
		);
	}
}
