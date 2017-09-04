<?php

/**
 * @covers Dash\mapValues
 */
class mapValuesTest extends PHPUnit_Framework_TestCase
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

		$actual = Dash\mapValues($iterable, $iteratee);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				[]
			],
			'With an indexed array' => [
				[
					'first',
					'second',
					'third',
				],
				[
					'0 is first',
					'1 is second',
					'2 is third',
				],
			],
			'With an associative array' => [
				[
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				],
				[
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
				],
			],
			'With an empty object' => [
				(object) [],
				[]
			],
			'With an object' => [
				(object) [
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				],
				[
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
				],
			],
			'With an empty ArrayObject' => [
				new ArrayObject([]),
				[]
			],
			'With an ArrayObject' => [
				new ArrayObject([
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				]),
				[
					'a' => 'a is first',
					'b' => 'b is second',
					'c' => 'c is third',
				],
			],
		];
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $path, $expected)
	{
		$actual = Dash\mapValues($iterable, $path);
		$this->assertSame($expected, $actual);
	}

	public function casesWithPath()
	{
		return [
			'With an array' => [
				[
					'w' => [
						'a' => [
							'b' => 'first'
						]
					],
					'x' => [
						'X' => 'missing'
					],
					'y' => [
						'a' => [
							'b' => 'third'
						]
					],
					'z' => [
						'a' => [
							'b' => 'fourth'
						]
					]
				],
				'a.b',
				[
					'w' => 'first',
					'x' => null,
					'y' => 'third',
					'z' => 'fourth'
				]
			],
		];
	}

	public function testWithoutIteratee()
	{
		$iterable = [0 => 'a', 1 => 'b', 2 => 'c'];
		$actual = Dash\mapValues($iterable);
		$expected = $iterable;
		$this->assertSame($expected, $actual);
	}
}
