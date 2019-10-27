<?php

/**
 * @covers Dash\flatten
 */
class flattenTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\flatten($iterable));
	}

	public function cases()
	{
		return [
			'With nulls' => [
				'iterable' => [null, null, null],
				'expected' => [null, null, null],
			],
			'With empty iterable' => [
				'iterable' => [],
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with only scalar values' => [
				'iterable' => [
					6,
					1,
					3,
				],
				'expected' => [6, 1, 3]
			],
			'With an indexed array with a mix of scalar and array values' => [
				'iterable' => [
					4,
					[2, 3],
					[7,9],
					8,
				],
				'expected' => [4, 2, 3, 7, 9, 8]
			],
			'With an indexed array with only array values' => [
				'iterable' => [
					[2, 3],
					[7,9],
				],
				'expected' => [2, 3, 7, 9]
			],

			/*
				With associative array
			 */

			'With an associative array with only scalar values' => [
				'iterable' => [
					'a' => 6,
					'b' => 1,
					'c' => 3,
				],
				'expected' => ['a' => 6, 'b' => 1, 'c' => 3]
			],
			'With an associative array with a mix of scalar and array values' => [
				'iterable' => [
					'a' => 4,
					'b' => [2, 3],
					'c' => [7,9],
					'd' => 8,
				],
				'expected' => ['a' => 4, 'b' => 2, 3, 'c' => 7, 9, 'd' => 8]
			],
			'With an associative array with only array values' => [
				'iterable' => [
					'b' => [2, 3],
					'c' => [7,9],
				],
				'expected' => ['b' => 2, 3, 'c' => 7, 9]
			],

			/*
				With stdClass
			 */

			'With an stdClass with only scalar values' => [
				'iterable' => (object) [
					'a' => 6,
					'b' => 1,
					'c' => 3,
				],
				'expected' => ['a' => 6, 'b' => 1, 'c' => 3]
			],
			'With an stdClass with a mix of scalar and array values' => [
				'iterable' => (object) [
					'a' => 4,
					'b' => [2, 3],
					'c' => [7,9],
					'd' => 8,
				],
				'expected' => ['a' => 4, 'b' => 2, 3, 'c' => 7, 9, 'd' => 8]
			],
			'With an stdClass with only array values' => [
				'iterable' => (object) [
					'b' => [2, 3],
					'c' => [7,9],
				],
				'expected' => ['b' => 2, 3, 'c' => 7, 9]
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject with only scalar values' => [
				'iterable' => new ArrayObject([
					'a' => 6,
					'b' => 1,
					'c' => 3,
				]),
				'expected' => ['a' => 6, 'b' => 1, 'c' => 3]
			],
			'With an ArrayObject with a mix of scalar and array values' => [
				'iterable' => new ArrayObject([
					'a' => 4,
					'b' => [2, 3],
					'c' => [7,9],
					'd' => 8,
				]),
				'expected' => ['a' => 4, 'b' => 2, 3, 'c' => 7, 9, 'd' => 8]
			],
			'With an ArrayObject with only array values' => [
				'iterable' => new ArrayObject([
					'b' => [2, 3],
					'c' => [7,9],
				]),
				'expected' => ['b' => 2, 3, 'c' => 7, 9]
			]
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\flatten($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\flatten expects iterable or stdClass or null but was given $type",
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
}
