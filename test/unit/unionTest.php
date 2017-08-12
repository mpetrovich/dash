<?php

use Dash\_;

class unionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForUnion
	 */
	public function testStandaloneUnion($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$actual = Dash\union($collection1, $collection2, $collection3);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForUnion
	 */
	public function testChainedUnion($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$_ = new _($collection1);
		$actual = $_->union($collection2, $collection3)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForUnion()
	{
		return array(
			'With empty arrays' => array(
				array(
					array(),
					array(),
					array(),
				),
				array()
			),
			'With non-intersecting arrays' => array(
				array(
					array(6, 5),
					array(1, 2),
					array(3, 4),
				),
				array(6, 5, 1, 2, 3, 4)
			),
			'With partially intersecting arrays' => array(
				array(
					array(4, 1, 2),
					array(1, 2, 3),
					array(1, 3, 5),
				),
				array(4, 1, 2, 3, 5)
			),
			'With fully overlapping arrays' => array(
				array(
					array(1, 2),
					array(2, 1),
					array(2, 1),
				),
				array(1, 2)
			),
		);
	}

	public function testUnionWithSingleArray()
	{
		$collections = array(
			array(4, 1, 2),
			array(1, 2, 3),
			array(1, 3, 5),
		);
		$expected = array(4, 1, 2, 3, 5);
		$actual = Dash\union($collections);

		$this->assertEquals($expected, $actual);
	}
}
