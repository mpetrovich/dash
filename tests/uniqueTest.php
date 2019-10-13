<?php

/**
 * @covers Dash\unique
 * @covers Dash\distinct
 */
class uniqueTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\unique($iterable));
		$this->assertSame($expected, Dash\distinct($iterable));
	}

	public function cases()
	{
		return [
			'With nulls' => [
				'iterable' => [null, null, null],
				'expected' => [null],
			],
			'With empty iterable' => [
				'iterable' => [],
				'expected' => []
			],

			/*
				With indexed array
			 */

			'With an indexed array with unique elements' => [
				'iterable' => [
					6,
					1,
					3,
				],
				'expected' => [6, 1, 3]
			],
			'With an indexed array with a mix of duplicate and unique elements' => [
				'iterable' => [
					4,
					2,
					1,
					6,
					3,
					4,
					5,
					1,
					3,
					5,
				],
				'expected' => [4, 2, 1, 6, 3, 5]
			],
			'With an indexed array with fully duplicated elements' => [
				'iterable' => [
					1,
					2,
					2,
					1,
					2,
					1,
				],
				'expected' => [1, 2]
			],

			/*
				With associative array
			 */

			'With an associative array with unique values' => [
				'iterable' => [
					'a' => 6,
					'b' => 5,
					'c' => 1,
					'd' => 2,
					'e' => 3,
					'f' => 4,
				],
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an associative array with a mix of duplicate and unique values' => [
				'iterable' => [
					'a' => 4,
					'b' => 2,
					'c' => 1,
					3,
					5,
					1,
					3,
					5,
				],
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an associative array with fully duplictaed values' => [
				'iterable' => [
					'a' => 1,
					'b' => 2,
					'c' => 2,
					'd' => 1,
					'a' => 2,
					'b' => 1,
				],
				'expected' => ['a' => 2, 'b' => 1]
			],

			/*
				With stdClass
			 */

			'With an stdClass with unique values' => [
				'iterable' => (object) [
					'a' => 6,
					'b' => 5,
					'c' => 1,
					'd' => 2,
					'e' => 3,
					'f' => 4,
				],
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an stdClass with a mix of duplicate and unique values' => [
				'iterable' => (object) [
					'a' => 4,
					'b' => 2,
					'c' => 1,
					3,
					5,
					1,
					3,
					5,
				],
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an stdClass with fully duplicated values' => [
				'iterable' => (object) [
					'a' => 1,
					'b' => 2,
					'c' => 2,
					'd' => 1,
					'a' => 2,
					'b' => 1,
				],
				'expected' => ['a' => 2, 'b' => 1]
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject with non-intersecting iterables' => [
				'iterable' => new ArrayObject([
					'a' => 6,
					'b' => 5,
					'c' => 1,
					'd' => 2,
					'e' => 3,
					'f' => 4,
				]),
				'expected' => ['a' => 6, 'b' => 5, 'c' => 1, 'd' => 2, 'e' => 3, 'f' => 4]
			],
			'With an ArrayObject with partially intersecting iterables' => [
				'iterable' => new ArrayObject([
					'a' => 4,
					'b' => 2,
					'c' => 1,
					3,
					5,
					1,
					3,
					5,
				]),
				'expected' => ['a' => 4, 'b' => 2, 'c' => 1, 3, 5]
			],
			'With an ArrayObject with fully overlapping iterables' => [
				'iterable' => new ArrayObject([
					'a' => 1,
					'b' => 2,
					'c' => 2,
					'd' => 1,
					'a' => 2,
					'b' => 1,
				]),
				'expected' => ['a' => 2, 'b' => 1]
			],

			/*
				Special cases
			 */

			'Values are compared using loose equality' => [
				'iterable' => [
					1,
					2,
					3,
					'2',
					3.0,
				],
				'expected' => [1, 2, 3]
			],
			'Duplicate values with a mix of indexed and non-indexed keys are de-duped, and the first key wins' => [
				'iterable' => [
					'a' => 1,
					'b' => 2,
					1,
					2,
					3
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
			Dash\unique($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\unique expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}

		try {
			Dash\distinct($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\unique expects iterable or stdClass or null but was given $type",
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
			Dash\unique([
				1, 3, 5,
				2, 4, 6,
				7, 8
			])
		);

		$this->assertSame(
			['a' => 1, 'c' => 3, 'b' => 2, 'd' => 4, 'e' => 5, 'f' => 6],
			Dash\unique([
				'a' => 1, 'c' => 3,
				'b' => 2, 'd' => 4,
				'e' => 5, 'f' => 6
			])
		);
	}
}
