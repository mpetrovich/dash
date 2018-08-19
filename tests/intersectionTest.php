<?php

/**
 * @covers Dash\intersection
 */
class intersectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$this->assertSame($expected, Dash\intersection($iterable1, $iterable2, $iterable3));
	}

	public function cases()
	{
		return [
			'With nulls' => [
				'iterables' => [null, null, null],
				'expected' => [],
			],
			'With empty iterables' => [
				'iterables' => [
					[],
					[],
					[],
				],
				'expected' => []
			],

			/*
				With indexed array
			 */

			'With an indexed array with non-intersecting iterables' => [
				'iterables' => [
					[6, 5],
					[1, 2],
					[3, 4],
				],
				'expected' => []
			],
			'With an indexed array with partially intersecting iterables' => [
				'iterables' => [
					[1, 2, 3, 4],
					[5, 4, 2],
					[4, 1, 6, 2],
				],
				'expected' => [2, 4]
			],
			'With an indexed array with fully overlapping iterables' => [
				'iterables' => [
					[1, 2],
					[2, 1],
					[2, 1],
				],
				'expected' => [1, 2]
			],


			/*
				With associative array
			 */

			'With an associative array with non-intersecting iterables' => [
				'iterables' => [
					['a' => 6, 'b' => 5],
					[1, 2],
					[3, 4],
				],
				'expected' => [],
			],
			'With an associative array with partially intersecting iterables' => [
				'iterables' => [
					['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
					[5, 4, 2],
					[4, 1, 6, 2],
				],
				'expected' => ['b' => 2, 'd' => 4]
			],
			'With an associative array with fully overlapping iterables' => [
				'iterables' => [
					['a' => 1, 'b' => 2],
					['c' => 2, 'd' => 1],
					['a' => 2, 'b' => 1],
				],
				'expected' => ['a' => 1, 'b' => 2]
			],

			/*
				With stdClass
			 */

			'With an stdClass with non-intersecting iterables' => [
				'iterables' => [
					(object) ['a' => 6, 'b' => 5],
					(object) [1, 2],
					(object) [3, 4],
				],
				'expected' => [],
			],
			'With an stdClass with partially intersecting iterables' => [
				'iterables' => [
					(object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
					(object) [5, 4, 2],
					(object) [4, 1, 6, 2],
				],
				'expected' => ['b' => 2, 'd' => 4]
			],
			'With an stdClass with fully overlapping iterables' => [
				'iterables' => [
					(object) ['a' => 1, 'b' => 2],
					(object) ['c' => 2, 'd' => 1],
					(object) ['a' => 2, 'b' => 1],
				],
				'expected' => ['a' => 1, 'b' => 2]
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject with non-intersecting iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 6, 'b' => 5]),
					new ArrayObject([1, 2]),
					new ArrayObject([3, 4]),
				],
				'expected' => [],
			],
			'With an ArrayObject with partially intersecting iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
					new ArrayObject([5, 4, 2]),
					new ArrayObject([4, 1, 6, 2]),
				],
				'expected' => ['b' => 2, 'd' => 4]
			],
			'With an ArrayObject with fully overlapping iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 1, 'b' => 2]),
					new ArrayObject(['c' => 2, 'd' => 1]),
					new ArrayObject(['a' => 2, 'b' => 1]),
				],
				'expected' => ['a' => 1, 'b' => 2]
			],

			/*
				Special cases
			 */

			'Values are compared using loose equality' => [
				'iterables' => [
					[1, 2, 3, 4],
					[5, '4', '2'],
					[4.0, 1, 6, 2.0],
				],
				'expected' => [2, 4]
			],
			'Non-indexed keys from the reference iterable are preserved' => [
				'iterables' => [
					['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
					['a' => 2, 'b' => 4],
					['a' => 4, 'b' => 2],
				],
				'expected' => ['b' => 2, 'd' => 4]
			],
			'Indexed keys from the reference iterable are not preserved' => [
				'iterables' => [
					[1, 2, 3, 4, 5],
					[2, 4],
					[4, 2]
				],
				'expected' => [2, 4]
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\intersection($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\intersection expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With an empty string' => [
				'iterable' => '',
				'type' => 'string',
			],
			'With a string' => [
				'iterable' => 'hello',
				'type' => 'string',
			],
			'With a zero number' => [
				'iterable' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'iterable' => 3.14,
				'type' => 'double',
			],
			'With a DateTime' => [
				'iterable' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(
			[2, 4],
			Dash\intersection(
				[1, 2, 3, 4, 5],
				['2', '4'],
				[4.0, 2.0]
			)
		);

		$this->assertSame(
			['b' => 2, 'd' => 4],
			Dash\intersection(
				['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
				['a' => 2, 'b' => 4],
				['a' => 4, 'b' => 2]
			)
		);
	}
}
