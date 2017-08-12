<?php

use Dash\Container;

class takeRightTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForTakeRight
	 */
	public function testStandaloneTakeRight($collection, $count, $fromEnd, $expected)
	{
		$actual = Dash\takeRight($collection, $count, $fromEnd);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForTakeRight
	 */
	public function testChainedTakeRight($collection, $count, $fromEnd, $expected)
	{
		$container = new Container($collection);
		$actual = $container->takeRight($count, $fromEnd)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForTakeRight()
	{
		return array(
			'With an empty array and a zero end offset' => array(
				array(),
				3,
				0,
				array()
			),
			'With an empty array and a non-zero end offset' => array(
				array(),
				3,
				2,
				array()
			),
			'With an indexed array and a zero end offset' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				3,
				0,
				array(2 => 'c', 3 => 'd', 4 => 'e')
			),
			'With an indexed array and a non-zero end offset' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				3,
				2,
				array(0 => 'a', 1 => 'b', 2 => 'c'),
			),
			'With an associative array and a zero end offset' => array(
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'),
				3,
				0,
				array('3rd' => 'c', '4th' => 'd', '5th' => 'e')
			),
			'With an associative array and a non-zero end offset' => array(
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'),
				3,
				2,
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c')
			),
		);
	}
}
