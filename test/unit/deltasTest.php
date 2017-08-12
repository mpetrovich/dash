<?php

use Dash\_;

class deltasTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForDeltas
	 */
	public function testStandaloneDeltas($collection, $expected)
	{
		$actual = Dash\deltas($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForDeltas
	 */
	public function testChainedDeltas($collection, $expected)
	{
		$actual = _::chain($collection)->deltas()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForDeltas()
	{
		return array(
			'With an empty array' => array(
				array(),
				array()
			),
			'With a non-empty array' => array(
				array(3, 8, 9, 9, 5, 13),
				array(0, 5, 1, 0, -4, 8)
			),
		);
	}
}
