<?php

class mapValuesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $expected)
	{
		$self = $this;
		$iteratee = function($value, $key, $collection2) use ($self, $collection) {
			$self->assertSame($collection, $collection2);
			return $key . ' is ' . $value;
		};

		$actual = Dash\mapValues($collection, $iteratee);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				[]
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
				(object) [],
				[]
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
				new ArrayObject([]),
				[]
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

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($collection, $path, $expected)
	{
		$actual = Dash\mapValues($collection, $path);
		$this->assertEquals($expected, $actual);
	}

	public function casesWithPath()
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
				array(
					'w' => 'first',
					'x' => null,
					'y' => 'third',
					'z' => 'fourth'
				)
			),
		);
	}

	public function testWithoutIteratee()
	{
		$collection = array(0 => 'a', 1 => 'b', 2 => 'c');
		$actual = Dash\mapValues($collection);
		$expected = $collection;
		$this->assertEquals($expected, $actual);
	}
}
