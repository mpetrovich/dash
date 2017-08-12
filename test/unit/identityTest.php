<?php

use Dash\_;

class identityTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIdentity
	 */
	public function testStandaloneIdentity($value, $expected)
	{
		$actual = Dash\identity($value);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForIdentity
	 */
	public function testChainedIdentity($value, $expected)
	{
		$chain = _::chain($value);
		$actual = $chain->identity()->value();
		$this->assertSame($expected, $actual);
	}

	public function casesForIdentity()
	{
		return array(
			'With an empty array' => array(
				array(),
				array()
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
