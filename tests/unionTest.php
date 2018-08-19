<?php

/**
 * @covers Dash\union
 */
class unionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterables, $expected)
	{
		list($iterable1, $iterable2, $iterable3) = $iterables;
		$this->assertSame($expected, Dash\union($iterable1, $iterable2, $iterable3));
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
				'expected' => [6, 5, 1, 2, 3, 4]
			],
			'With an indexed array with partially intersecting iterables' => [
				'iterables' => [
					[4, 2, 1, 6],
					[3, 4, 5],
					[1, 3, 5],
				],
				'expected' => [4, 2, 1, 6, 3, 5]
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
					['c' => 1, 'd' => 2],
					['e' => 3, 'f' => 4],
				],
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an associative array with partially intersecting iterables' => [
				'iterables' => [
					['a' => 4, 'b' => 2, 'c' => 1],
					[3, 5],
					[1, 3, 5],
				],
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an associative array with fully overlapping iterables' => [
				'iterables' => [
					['a' => 1, 'b' => 2],
					['c' => 2, 'd' => 1],
					['a' => 2, 'b' => 1],
				],
				'expected' => ['a' => 2, 'b' => 1]
			],

			/*
				With stdClass
			 */

			'With an stdClass with non-intersecting iterables' => [
				'iterables' => [
					(object) ['a' => 6, 'b' => 5],
					(object) ['c' => 1, 'd' => 2],
					(object) ['e' => 3, 'f' => 4],
				],
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an stdClass with partially intersecting iterables' => [
				'iterables' => [
					(object) ['a' => 4, 'b' => 2, 'c' => 1],
					(object) [3, 5],
					(object) [1, 3, 5],
				],
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an stdClass with fully overlapping iterables' => [
				'iterables' => [
					(object) ['a' => 1, 'b' => 2],
					(object) ['c' => 2, 'd' => 1],
					(object) ['a' => 2, 'b' => 1],
				],
				'expected' => ['a' => 2, 'b' => 1]
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject with non-intersecting iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 6, 'b' => 5]),
					new ArrayObject(['c' => 1, 'd' => 2]),
					new ArrayObject(['e' => 3, 'f' => 4]),
				],
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an ArrayObject with partially intersecting iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 4, 'b' => 2, 'c' => 1]),
					new ArrayObject([3, 5]),
					new ArrayObject([1, 3, 5]),
				],
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an ArrayObject with fully overlapping iterables' => [
				'iterables' => [
					new ArrayObject(['a' => 1, 'b' => 2]),
					new ArrayObject(['c' => 2, 'd' => 1]),
					new ArrayObject(['a' => 2, 'b' => 1]),
				],
				'expected' => ['a' => 2, 'b' => 1]
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
				'expected' => [1, 2, 3, 4, 5]
			],
			'Non-indexed keys from the iterables are preserved, and later keys overwrite earlier ones' => [
				'iterables' => [
					['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5],
					['a' => 2, 'b' => 4],
					['a' => 3]
				],
				'expected' => ['a' => 3, 'b' => 4, 'e' => 5]
			],
			'Indexed keys from the iterables are not preserved' => [
				'iterables' => [
					[1, 2, 3, 4, 5],
					[2, 4],
					[3]
				],
				'expected' => [1, 2, 3, 4, 5]
			],
			'Duplicate values with a mix of indexed and non-indexed keys are de-duped, and the first key wins' => [
				'iterables' => [
					['a' => 1, 'b' => 2],
					[1, 2],
					[3]
				],
				'expected' => ['a' => 1, 'b' => 2, 2 => 3]
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
			Dash\union($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\union expects iterable or stdClass or null but was given $type",
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
			[1, 3, 5, 2, 4, 6, 7, 8],
			Dash\union(
				[1, 3, 5],
				[2, 4, 6],
				[7, 8]
			)
		);

		$this->assertSame(
			['a' => 1, 'c' => 3, 'b' => 2, 'd' => 4, 'e' => 5, 'f' => 6],
			Dash\union(
				['a' => 1, 'c' => 3],
				['b' => 2, 'd' => 4],
				['e' => 5, 'f' => 6]
			)
		);
	}
}
