<?php

/**
 * @covers Dash\difference
 */
class differenceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$this->assertSame($expected, Dash\difference($iterable1, $iterable2, $iterable3));
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
				'expected' => [6, 5]
			],
			'With an indexed array with partially intersecting iterables' => [
				'iterables' => [
					[4, 2, 1, 6],
					[3, 4, 5],
					[1, 3, 5],
				],
				'expected' => [2, 6]
			],
			'With an indexed array with fully overlapping iterables' => [
				'iterables' => [
					[1, 2],
					[2, 1],
					[2, 1],
				],
				'expected' => []
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
				'expected' => ['a' => 6, 'b' => 5],
			],
			'With an associative array with partially intersecting iterables' => [
				'iterables' => [
					['a' => 4, 'b' => 2, 'c' => 1],
					[3, 4, 5],
					[1, 3, 5],
				],
				'expected' => ['b' => 2]
			],
			'With an associative array with fully overlapping iterables' => [
				'iterables' => [
					['a' => 1, 'b' => 2],
					['c' => 2, 'd' => 1],
					['a' => 2, 'b' => 1],
				],
				'expected' => []
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
				'expected' => ['a' => 6, 'b' => 5],
			],
			'With an stdClass with partially intersecting iterables' => [
				'iterables' => [
					(object) ['a' => 4, 'b' => 2, 'c' => 1],
					(object) [3, 4, 5],
					(object) [1, 3, 5],
				],
				'expected' => ['b' => 2]
			],
			'With an stdClass with fully overlapping iterables' => [
				'iterables' => [
					(object) ['a' => 1, 'b' => 2],
					(object) ['c' => 2, 'd' => 1],
					(object) ['a' => 2, 'b' => 1],
				],
				'expected' => []
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
				'expected' => ['a' => 6, 'b' => 5],
			],
			'With an ArrayObject with partially intersecting iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 4, 'b' => 2, 'c' => 1]),
					new ArrayObject([3, 4, 5]),
					new ArrayObject([1, 3, 5]),
				],
				'expected' => ['b' => 2]
			],
			'With an ArrayObject with fully overlapping iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 1, 'b' => 2]),
					new ArrayObject(['c' => 2, 'd' => 1]),
					new ArrayObject(['a' => 2, 'b' => 1]),
				],
				'expected' => []
			],

			/*
				Special cases
			 */

			'Values are compared using loose equality' => [
				'iterables' => [
					[1, 2, 3, 4, 5],
					['2', 4],
					[3.0, 4]
				],
				'expected' => [1, 5]
			],
			'Non-indexed keys from the reference iterable are preserved' => [
				'iterables' => [
					['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
					['a' => 2, 'b' => 4],
					['a' => 3]
				],
				'expected' => ['a' => 1, 'e' => 5]
			],
			'Indexed keys from the reference iterable are not preserved' => [
				'iterables' => [
					[1, 2, 3, 4, 5],
					[2, 4],
					[3]
				],
				'expected' => [1, 5]
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
			Dash\difference($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\difference expects iterable or stdClass or null but was given $type",
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
			[1, 5],
			Dash\difference(
				[1, 2, 3, 4, 5],
				['2', 4],
				[3.0, 4]
			)
		);

		$this->assertSame(
			['a' => 1, 'e' => 5],
			Dash\difference(
				['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
				['a' => 2, 'b' => 4],
				['a' => 3.0, 'b' => 4]
			)
		);
	}
}
