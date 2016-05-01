<?php

use Dash\Collections;
use Dash\Container;

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

		$actual = Collections\map($collection, $iteratee);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForMap
	 */
	public function testChainedMap($collection, $expected)
	{
		$self = $this;
		$iteratee = function($value, $key, $collection2) use ($self, $collection) {
			$self->assertSame($collection, $collection2);
			return $key . ' is ' . $value;
		};

		$container = new Container($collection);
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
		$actual = Collections\map($collection, $path);
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
		$actual = Collections\map($collection);
		$expected = $collection;
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForTestMapPerformance
	 */
	public function testMapPerformance($count) {
		$memoryLimit = ini_get('memory_limit');
		ini_set('memory_limit', '-1');

		for ($i = 0; $i < $count; $i++) {
			$collection[] = mt_rand(1, $count);
		}

		$start = microtime(true);
		$mappedDash = Collections\map($collection, function($value, $key) {
			return $value * $value;
		});
		$end = microtime(true);
		$elapsedDash = ($end - $start) * 1000;

		$start = microtime(true);
		$mappedNative = array_map(function($value) {
			return $value * $value;
		}, $collection);
		$end = microtime(true);
		$elapsedNative = ($end - $start) * 1000;

		$start = microtime(true);
		$mappedFor = array();
		$iteratee = function($value, $key) { return $value * $value; };
		foreach($collection as $key => $value) {
			$mappedFor[] = call_user_func($iteratee, $value, $key);
		}
		$end = microtime(true);
		$elapsedFor = ($end - $start) * 1000;

		print_r(array($count => array(
			'native' => $elapsedNative,
			'for   ' => $elapsedFor,
			'dash  ' => $elapsedDash,
		)));

		ini_set('memory_limit', $memoryLimit);
		$this->assertSame($mappedNative, $mappedDash, 'Native and Dash should be identical');
		$this->assertSame($mappedFor, $mappedNative, 'For loop and native should be identical');
		$this->assertLessThanOrEqual(10, $elapsedDash / $elapsedNative, 'Dash should be within an order of magnitude as fast as native');
		$this->assertLessThanOrEqual(10, $elapsedDash / $elapsedFor, 'Dash should be within an order of magnitude as fast as for loop');
		$this->assertLessThanOrEqual($elapsedFor, $elapsedNative, 'Native should be the same or faster than for loop');
	}

	public function casesForTestMapPerformance() {
		return array(
			array(1e1),
			array(1e2),
			array(1e3),
			array(1e4),
			array(1e5),
			array(1e6),
		);
	}
}
