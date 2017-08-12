<?php

use Dash\_;

class intersectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForIntersection
	 */
	public function testStandaloneIntersection($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$actual = Dash\intersection($collection1, $collection2, $collection3);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForIntersection
	 */
	public function testChainedIntersection($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$container = new _($collection1);
		$actual = $container->intersection($collection2, $collection3)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForIntersection()
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
				array()
			),
			'With partially intersecting arrays' => array(
				array(
					array(4, 1, 2),
					array(1, 2, 3),
					array(1, 3, 5),
				),
				array(1)
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

	public function testIntersectionWithSingleArray()
	{
		$collections = array(
			array(4, 1, 2),
			array(1, 2, 3),
			array(1, 3, 5),
		);
		$expected = array(1);
		$actual = Dash\intersection($collections);

		$this->assertEquals($expected, $actual);
	}
}
