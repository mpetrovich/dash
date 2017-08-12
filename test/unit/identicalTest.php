<?php

use Dash\_;

class identicalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIdentical
	 */
	public function testStandaloneIdentical($a, $b, $expected)
	{
		$actual = Dash\identical($a, $b);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForIdentical
	 */
	public function testChainedIdentical($a, $b, $expected)
	{
		$_ = new _($a);
		$actual = $_->identical($b)->value();
		$this->assertSame($expected, $actual);
	}

	public function casesForIdentical()
	{
		return array(
			'With two identical arrays' => array(
				array(1, 2, 3),
				array(1, 2, 3),
				true
			),
			'With two non-identical arrays' => array(
				array(1, 2, 3),
				array(1, '2', 3),
				false
			),
			'With two identical objects' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c'),
				array(0 => 'a', 1 => 'b', 2 => 'c'),
				true
			),
			'With two non-identical objects' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c'),
				array(0 => 'a', 1 => 'x', 2 => 'c'),
				false
			),
			'With two identical strings' => array(
				'abc',
				'abc',
				true
			),
			'With two non-identical strings' => array(
				'abc',
				'def',
				false
			),
			'With two identical numbers' => array(
				123,
				123,
				true
			),
			'With two non-identical numbers' => array(
				123,
				321,
				false
			),
			'With two identical booleans' => array(
				true,
				true,
				true
			),
			'With two non-identical booleans' => array(
				true,
				false,
				false
			),
			'With two equal but non-identical values' => array(
				123,
				'123',
				false
			),
			'With two equal but non-identical values' => array(
				false,
				'',
				false
			),
		);
	}
}
