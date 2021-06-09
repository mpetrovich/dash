<?php

/**
 * @covers Dash\keyBy
 * @covers Dash\Curry\keyBy
 * @covers Dash\indexBy
 * @covers Dash\Curry\indexBy
 */
class keyByTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\keyBy($iterable, $iteratee));
		$this->assertSame($expected, Dash\indexBy($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $iteratee, $expected)
	{
		$keyBy = Dash\Curry\keyBy($iteratee);
		$this->assertSame($expected, $keyBy($iterable));

		$indexBy = Dash\Curry\indexBy($iteratee);
		$this->assertSame($expected, $indexBy($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3],
			],
			'With an indexed array with several elements' => [
				'iterable' => [3, 1, 2, 4],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3, 2 => 1, 4 => 2, 8 => 4],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['c' => 3],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3],
			],
			'With an associative array with several elements' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3, 2 => 1, 4 => 2, 8 => 4],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [],
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['c' => 3],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3],
			],
			'With an stdClass with several elements' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3, 2 => 1, 4 => 2, 8 => 4],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [],
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['c' => 3]),
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3],
			],
			'With an ArrayObject with several elements' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4]),
				'iteratee' => function ($value) {
					return $value * 2;
				},
				'expected' => [6 => 3, 2 => 1, 4 => 2, 8 => 4],
			],
		];
	}

	public function testIterateeArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];

		$iteratee = function ($value, $key, $passedIterable) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			$this->assertSame($iterable, $passedIterable);
			return $value * 2;
		};

		$iterated = [];
		$result = Dash\keyBy($iterable, $iteratee);
		$this->assertSame([2 => 1, 4 => 2, 6 => 3], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);

		$iterated = [];
		$result = Dash\indexBy($iterable, $iteratee);
		$this->assertSame([2 => 1, 4 => 2, 6 => 3], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);
	}

	/**
	 * @dataProvider casesDefaultIteratee
	 */
	public function testDefaultIteratee($iterable, $expected)
	{
		$this->assertSame($expected, Dash\keyBy($iterable));
		$this->assertSame($expected, Dash\indexBy($iterable));
	}

	public function casesDefaultIteratee()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => [],
			],
			'With an array' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => [3 => 3, 1 => 1, 2 => 2, 4 => 4],
			],
		];
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\keyBy($iterable, $iteratee));
		$this->assertSame($expected, Dash\indexBy($iterable, $iteratee));
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
					'first' => ['a' => ['b' => 'first'], 'id' => 4],
					null => ['x' => 'missing', 'id' => 2],
					'third' => ['a' => ['b' => 'third'], 'id' => 3],
				],
			],
			'With an integer iteratee' => [
				'iterable' => [
					'w' => ['one', 'two', 'three', 'four'],
					'x' => ['uno', 'dos', 'tres', 'cuatro'],
					'y' => ['un', 'deux', 'trois', 'quatre'],
					'z' => ['uno', 'due', 'tre', 'quattro'],
				],
				'iteratee' => 0,
				'expected' => [
					'one' => ['one', 'two', 'three', 'four'],
					'uno' => ['uno', 'due', 'tre', 'quattro'],
					'un' => ['un', 'deux', 'trois', 'quatre'],
				],
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 */
	public function testTypeAssertions($iterable, $type)
	{
		$this->expectException(InvalidArgumentException::class);

		try {
			Dash\keyBy($iterable);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\keyBy expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}

		try {
			Dash\indexBy($iterable);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\keyBy expects iterable or stdClass or null but was given $type",
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
		$data = [
			['first' => 'John', 'last' => 'Doe'],
			['first' => 'Alice', 'last' => 'Hart'],
			['first' => 'Jane', 'last' => 'Smith'],
			['first' => 'Peter', 'last' => 'Gibbons'],
			['first' => 'Fred', 'last' => 'Durst'],
		];

		$this->assertSame(
			[
				'John Doe' => ['first' => 'John', 'last' => 'Doe'],
				'Alice Hart' => ['first' => 'Alice', 'last' => 'Hart'],
				'Jane Smith' => ['first' => 'Jane', 'last' => 'Smith'],
				'Peter Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
				'Fred Durst' => ['first' => 'Fred', 'last' => 'Durst'],
			],
			Dash\keyBy($data, function ($value) {
				return $value['first'] . ' ' . $value['last'];
			})
		);

		$this->assertSame(
			[
				'Doe' => ['first' => 'John', 'last' => 'Doe'],
				'Hart' => ['first' => 'Alice', 'last' => 'Hart'],
				'Smith' => ['first' => 'Jane', 'last' => 'Smith'],
				'Gibbons' => ['first' => 'Peter', 'last' => 'Gibbons'],
				'Durst' => ['first' => 'Fred', 'last' => 'Durst'],
			],
			Dash\keyBy($data, 'last')
		);
	}
}
