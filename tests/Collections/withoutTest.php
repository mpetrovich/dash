<?php

use Dash\Collections;
use Dash\Container;

class withoutTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForWithout
	 */
	public function testStandaloneWithout($collection, $without, $expected)
	{
		$actual = Collections\without($collection, $without);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForWithout
	 */
	public function testChainedWithout($collection, $without, $expected)
	{
		$container = new Container($collection);
		$actual = $container->without($without)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForWithout()
	{
		return array(
			'With an empty array' => array(
				array(),
				array(),
				array()
			),
			'With no matching exclusions' => array(
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'),
				array(1 => 'e', 2 => 'f'),
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd')
			),
			'With matching exclusions' => array(
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'),
				array(1 => 'c', 2 => 'b'),
				array(1 => 'a', 4 => 'd')
			),
		);
	}
}
