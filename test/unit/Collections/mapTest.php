<?php

use Dash\_;

class mapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMap
	 */
	public function testStandaloneMap($collection, $expected)
	{
		$self = $this;
		$iteratee = function($value, $key, $collection2) use ($self, $collection) {
			$self->assertSame($collection, $collection2);
			return $key . ' is ' . $value;
		};

		$actual = Dash\map($collection, $iteratee);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForMap
	 */
	public function testChainedMap($collection, $expected)
	{
		$self = $this;
		$array = Dash\toArray($collection);
		$iteratee = function($value, $key, $collection) use ($self, $array) {
			$self->assertSame($collection, $array);
			return $key . ' is ' . $value;
		};

		$container = new _($collection);
		$actual = $container->map($iteratee)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMap()
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
				array()
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

	/**
	 * @dataProvider casesForMapWithPath
	 */
	public function testMapWithPath($collection, $path, $expected)
	{
		$actual = Dash\map($collection, $path);
		$this->assertEquals($expected, $actual);
	}

	public function casesForMapWithPath()
	{
		return array(
			'With a non-empty array' => array(
				array(
					'w' => array(
						'a' => array(
							'b' => 'first'
						)
					),
					'x' => array(
						'X' => 'missing'
					),
					'y' => array(
						'a' => array(
							'b' => 'third'
						)
					),
					'z' => array(
						'a' => array(
							'b' => 'fourth'
						)
					)
				),
				'a.b',
				array('first', null, 'third', 'fourth')
			),
		);
	}

	public function testMapWithoutIteratee()
	{
		$collection = array(0 => 'a', 1 => 'b', 2 => 'c');
		$actual = Dash\map($collection);
		$expected = $collection;
		$this->assertEquals($expected, $actual);
	}
}
