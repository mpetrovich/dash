<?php

use Dash\_;

class sizeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForSize
	 */
	public function testStandaloneSize($collection, $expected)
	{
		$actual = Dash\size($collection);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForSize
	 */
	public function testChainedSize($collection, $expected)
	{
		$_ = new _($collection);
		$actual = $_->size()->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForSize()
	{
		return array(
			'With an empty array' => array(
				array(),
				0
			),
			'With an empty object' => array(
				(object) array(),
				0
			),
			'With an empty Countable' => array(
				new ArrayObject(array()),
				0
			),
			'With a non-empty array' => array(
				array(1, 2, 3),
				3
			),
			'With a non-empty object' => array(
				(object) array('a' => 1, 'b' => 2, 'c' => 3),
				3
			),
			'With a non-empty Countable' => array(
				new ArrayObject(array(1, 2, 3)),
				3
			),
		);
	}
}
