<?php

use Dash\Collections;
use Dash\Container;

class eachTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForEach
	 */
	public function testStandaloneEach($collection, $expected)
	{
		$self = $this;
		$iterated = array();
		$iteratee = function($value, $key, $collection2) use ($self, $collection, &$iterated) {
			$self->assertSame($collection, $collection2);
			$iterated[] = $key . ' is ' . $value;
		};

		Collections\each($collection, $iteratee);
		$this->assertEquals($expected, $iterated);
	}

	/**
	 * @dataProvider casesForEach
	 */
	public function testChainedEach($collection, $expected)
	{
		$self = $this;
		$iterated = array();
		$array = Collections\toArray($collection);
		$iteratee = function($value, $key, $collection) use ($self, $array, &$iterated) {
			$self->assertSame($collection, $array);
			$iterated[] = $key . ' is ' . $value;
		};

		$container = new Container($collection);
		$container->each($iteratee)->value();
		$this->assertEquals($expected, $iterated);
	}

	public function casesForEach()
	{
		return array(
			'With an empty array' => array(
				array(),
				array()
			),
			'With an indexed array' => array(
				array(
					'first',
					'second',
					'third',
				),
				array(
					'0 is first',
					'1 is second',
					'2 is third',
				),
			),
			'With an associative array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
			'With an empty object' => array(
				(object) array(),
				array()
			),
			'With a non-empty object' => array(
				(object) array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
			'With an empty ArrayObject' => array(
				new ArrayObject(array()),
				array(),
			),
			'With a non-empty ArrayObject' => array(
				new ArrayObject(array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				)),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
		);
	}
}
