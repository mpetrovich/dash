<?php

/**
 * @covers Dash\groupBy
 * @covers Dash\Curry\groupBy
 */
class groupByTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\groupBy($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $iteratee, $expected)
	{
		$groupBy = Dash\Curry\groupBy($iteratee, null);
		$this->assertSame($expected, $groupBy($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'iteratee' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'iteratee' => 'Dash\isOdd',
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3]],
			],
			'With an indexed array with several elements' => [
				'iterable' => [3, 1, 2, 4],
				'iteratee' => 'Dash\isOdd',
				'expected' => [
					true => [3, 1],
					false => [2, 4],
				],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['c' => 3],
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3]],
			],
			'With an associative array with several elements' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3, 1], false => [2, 4]],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'iteratee' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['c' => 3],
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3]],
			],
			'With an stdClass with several elements' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3, 1], false => [2, 4]],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'iteratee' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['c' => 3]),
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3]],
			],
			'With an ArrayObject with several elements' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4]),
				'iteratee' => 'Dash\isOdd',
				'expected' => [true => [3, 1], false => [2, 4]],
			],
		];
	}

	public function testIterateeArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];

		$iteratee = function ($value, $key, $passedIterable) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			$this->assertSame($iterable, $passedIterable);
			return Dash\isOdd($value);
		};

		$iterated = [];
		$result = Dash\groupBy($iterable, $iteratee);
		$this->assertSame([true => [1, 3], false => [2]], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);
	}

	/**
	 * @dataProvider casesDefaultIteratee
	 */
	public function testDefaultIteratee($iterable, $expected)
	{
		$this->assertSame($expected, Dash\groupBy($iterable));
	}

	public function casesDefaultIteratee()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => [],
			],
			'With an array' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 3],
				'expected' => [3 => [3, 3], 1 => [1], 2 => [2]]
			],
		];
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\groupBy($iterable, $iteratee));
	}

	public function casesWithPath()
	{
		return [
			'With a string iteratee' => [
				'iterable' => [
					'w' => ['a' => ['b' => 'first'], 'id' => 1],
					'x' => ['x' => 'missing', 'id' => 2],
					'y' => ['a' => ['b' => 'third'], 'id' => 3],
					'z' => ['a' => ['b' => 'first'], 'id' => 4],
				],
				'iteratee' => 'a.b',
				'expected' => [
					'first' => [
						['a' => ['b' => 'first'], 'id' => 1],
						['a' => ['b' => 'first'], 'id' => 4],
					],
					null => [
						['x' => 'missing', 'id' => 2]
					],
					'third' => [
						['a' => ['b' => 'third'], 'id' => 3]
					],
				],
			],
			'With a numeric iteratee' => [
				'iterable' => [
					'w' => ['one', 'two', 'three', 'four'],
					'x' => ['uno', 'dos', 'tres', 'cuatro'],
					'y' => ['un', 'deux', 'trois', 'quatre'],
					'z' => ['uno', 'due', 'tre', 'quattro'],
				],
				'iteratee' => 0,
				'expected' => [
					'one' => [
						['one', 'two', 'three', 'four'],
					],
					'uno' => [
						['uno', 'dos', 'tres', 'cuatro'],
						['uno', 'due', 'tre', 'quattro'],
					],
					'un' => [
						['un', 'deux', 'trois', 'quatre'],
					],
				],
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
			Dash\groupBy($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\groupBy expects iterable or stdClass or null but was given $type",
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
			[true => [1, 3], false => [2]],
			Dash\groupBy(['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isOdd')
		);

		$this->assertSame(
			[2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4.1]],
			Dash\groupBy([2.1, 2.5, 3.5, 3.9, 4.1], Dash\unary('floor'))
		);

		$data = [
			['first' => 'John', 'last' => 'Doe'],
			['first' => 'Alice', 'last' => 'Hart'],
			['first' => 'Anonymous'],
			['first' => 'Jane', 'last' => 'Doe'],
			['first' => 'Peter', 'last' => 'Gibbons'],
			['first' => 'Fred', 'last' => 'Hart'],
		];

		$this->assertSame(
			[
				'Doe' => [
					['first' => 'John', 'last' => 'Doe'],
					['first' => 'Jane', 'last' => 'Doe'],
				],
				'Hart' => [
					['first' => 'Alice', 'last' => 'Hart'],
					['first' => 'Fred', 'last' => 'Hart'],
				],
				null => [
					['first' => 'Anonymous'],
				],
				'Gibbons' => [
					['first' => 'Peter', 'last' => 'Gibbons'],
				],
			],
			Dash\groupBy($data, 'last')
		);

		$this->assertSame(
			[
				'Doe' => [
					['first' => 'John', 'last' => 'Doe'],
					['first' => 'Jane', 'last' => 'Doe'],
				],
				'Hart' => [
					['first' => 'Alice', 'last' => 'Hart'],
					['first' => 'Fred', 'last' => 'Hart'],
				],
				'Unknown' => [
					['first' => 'Anonymous'],
				],
				'Gibbons' => [
					['first' => 'Peter', 'last' => 'Gibbons'],
				],
			],
			Dash\groupBy($data, 'last', 'Unknown')
		);
	}
}
