<?php

use Dash\Container;
use Dash\Functions;

class identityTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIdentity
	 */
	public function testStandaloneIdentity($value, $expected)
	{
		$actual = Functions\identity($value);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForIdentity
	 */
	public function testChainedIdentity($value, $expected)
	{
		$container = new Container($value);
		$actual = $container->identity()->value();
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
