<?php

use Dash\_;

class lastTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForLast
	 */
	public function testStandaloneLast($collection, $expected)
	{
		$actual = Dash\last($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForLast
	 */
	public function testChainedLast($collection, $expected)
	{
		$actual = _::chain($collection)->last()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForLast()
	{
		return array(
			'With an empty array' => array(
				[],
				null
			),
			'With a non-empty array' => array(
				array('a', 'b', 'c'),
				'c'
			),
			'With a non-empty array with null as the last element' => array(
				array('a', 'b', null),
				null
			),
		);
	}
}
