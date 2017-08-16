<?php

/**
 * @covers Dash\map
 */
class mapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$self = $this;
		$iteratee = function ($value, $key, $iterable2) use ($self, $iterable) {
			$self->assertSame($iterable, $iterable2);
			return $key . ' is ' . $value;
		};

		$actual = Dash\map($iterable, $iteratee);
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
					'a is first',
					'b is second',
					'c is third',
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
					'a is first',
					'b is second',
					'c is third',
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
					'a is first',
					'b is second',
					'c is third',
				),
			),
		);
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $path, $expected)
	{
		$actual = Dash\map($iterable, $path);
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
				array('first', null, 'third', 'fourth')
			),
		);
	}

	public function testWithoutIteratee()
	{
		$iterable = array(0 => 'a', 1 => 'b', 2 => 'c');
		$actual = Dash\map($iterable);
		$expected = $iterable;
		$this->assertEquals($expected, $actual);
	}
}
