<?php

use Dash\Collections;
use Dash\Container;

class differenceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForDifference
	 */
	public function testStandaloneDifference($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$actual = Collections\difference($collection1, $collection2, $collection3);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForDifference
	 */
	public function testChainedDifference($collections, $expected)
	{
		list($collection1, $collection2, $collection3) = $collections;
		$container = new Container($collection1);
		$actual = $container->difference($collection2, $collection3)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForDifference()
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
				array(4, 2, 3, 5)
			),
			'With fully overlapping arrays' => array(
				array(
					array(1, 2),
					array(2, 1),
					array(2, 1),
				),
				array()
			),
		);
	}
}
