<?php

use Dash\Collection;
use Dash\Container;

class mapValuesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMapValues
	 */
	public function testMapValues($collection, $expected)
	{
		$self = $this;
		$iteratee = function($value, $key, $collection2) use ($self, $collection) {
			$self->assertSame($collection, $collection2);
			return $key . ' is ' . $value;
		};

		// As a standalone operation
		$actual = Collection\mapValues($collection, $iteratee);
		$this->assertEquals($expected, $actual);

		// As a chained operation
		$container = new Container($collection);
		$actual = $container->mapValues($iteratee)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMapValues()
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
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
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
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
				),
			),
			'With an empty ArrayObject' => array(
				new ArrayObject(array()),
				array()
			),
			'With a non-empty ArrayObject' => array(
				new ArrayObject(array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				)),
				array(
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
				),
			),
		);
	}
}
