<?php

use Dash\_;

class takeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForTake
	 */
	public function testStandaloneTake($collection, $count, $fromStart, $expected)
	{
		$actual = Dash\take($collection, $count, $fromStart);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForTake
	 */
	public function testChainedTake($collection, $count, $fromStart, $expected)
	{
		$actual = _::chain($collection)->take($count, $fromStart)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForTake()
	{
		return array(
			'With an empty array and a zero start offset' => array(
				[],
				3,
				0,
				[]
			),
			'With an empty array and a non-zero start offset' => array(
				[],
				3,
				2,
				[]
			),
			'With an indexed array and a zero start offset' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				3,
				0,
				array(0 => 'a', 1 => 'b', 2 => 'c')
			),
			'With an indexed array and a non-zero start offset' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				3,
				2,
				array(2 => 'c', 3 => 'd', 4 => 'e'),
			),
			'With an associative array and a zero start offset' => array(
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'),
				3,
				0,
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c')
			),
			'With an associative array and a non-zero start offset' => array(
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'),
				3,
				2,
				array('3rd' => 'c', '4th' => 'd', '5th' => 'e')
			),
		);
	}
}
