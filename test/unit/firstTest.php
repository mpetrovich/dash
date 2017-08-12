<?php

use Dash\_;

class firstTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForFirst
	 */
	public function testStandaloneFirst($collection, $expected)
	{
		$actual = Dash\first($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForFirst
	 */
	public function testChainedFirst($collection, $expected)
	{
		$actual = _::chain($collection)->first()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForFirst()
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
