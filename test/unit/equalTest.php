<?php

use Dash\_;

class equalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForEqual
	 */
	public function testStandaloneEqual($a, $b, $expected)
	{
		$actual = Dash\equal($a, $b);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForEqual
	 */
	public function testChainedEqual($a, $b, $expected)
	{
		$_ = new _($a);
		$actual = $_->equal($b)->value();
		$this->assertSame($expected, $actual);
	}

	public function casesForEqual()
	{
		return array(
			'should return true when the values are identical' => array(
				3,
				3,
				true
			),
			'should return true when the values are equal but not identical' => array(
				'3',
				3,
				true
			),
			'should return false when the values are not equal' => array(
				'4',
				3,
				false
			),
		);
	}
}
