<?php

/**
 * @covers Dash\map
 * @covers Dash\_map
 */
class mapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$iteratee = function ($value) {
			return $value * 2;
		};
		$this->assertSame($expected, Dash\map($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$iteratee = function ($value) {
			return $value * 2;
		};
		$map = Dash\_map($iteratee);
		$this->assertEquals($expected, $map($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'expected' => [6],
			],
			'With an indexed array with several elements' => [
				'iterable' => [3, 1, 2, 4],
				'expected' => [6, 2, 4, 8],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['c' => 3],
				'expected' => [6],
			],
			'With an associative array with several elements' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => [6, 2, 4, 8],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => [],
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['c' => 3],
				'expected' => [6],
			],
			'With an stdClass with several elements' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => [6, 2, 4, 8],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => [],
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['c' => 3]),
				'expected' => [6],
			],
			'With an ArrayObject with several elements' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4]),
				'expected' => [6, 2, 4, 8],
			],
		];
	}

	public function testIterateeArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iterated = [];

		$iteratee = function ($value, $key, $passedIterable) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			$this->assertSame($iterable, $passedIterable);
			return $value * 2;
		};

		$result = Dash\map($iterable, $iteratee);

		$this->assertSame([2, 4, 6], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);
	}

	/**
	 * @dataProvider casesDefaultIteratee
	 */
	public function testDefaultIteratee($iterable, $expected)
	{
		$this->assertSame($expected, Dash\map($iterable));
	}

	public function casesDefaultIteratee()
	{
		$a = (object) ['name' => 'a'];
		$b = (object) ['name' => 'b'];
		$c = (object) ['name' => 'c'];

		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => [],
			],
			'With an array' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => [3, 1, 2, 4],
			],
			'With an array of objects' => [
				'iterable' => ['a' => $a, 'b' => $b, 'c' => $c],
				'expected' => [$a, $b, $c],
			],
		];
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\map($iterable, $iteratee));
	}

	public function casesWithPath()
	{
		return [
			'With a string iteratee' => [
				'iterable' => [
					'w' => ['a' => ['b' => 'first']],
					'x' => ['z' => 'missing'],
					'y' => ['a' => ['b' => 'third']],
					'z' => ['a' => ['b' => 'fourth']],
				],
				'iteratee' => 'a.b',
				'expected' => ['first', null, 'third', 'fourth'],
			],
			'With a numeric iteratee' => [
				'iterable' => [
					'w' => ['one', 'two', 'three', 'four'],
					'x' => ['uno', 'dos', 'tres', 'cuatro'],
					'y' => ['un', 'deux', 'trois', 'quatre'],
				],
				'iteratee' => 2,
				'expected' => ['three', 'tres', 'trois'],
			],
			'With a non-matching string iteratee' => [
				'iterable' => [1, 2, 3],
				'iteratee' => 'foo',
				'expected' => [null, null, null],
			],
		];
	}

	/**
	 * Verifies that when the iteratee is a property name with the same name as a global function,
	 * the property name takes precedence.
	 */
	public function testPropertyNamePrecendence()
	{
		$actual = Dash\map([
			'w' => ['abs' => 'a'],
			'x' => ['abs' => 'b'],
			'y' => ['abs' => 'c'],
		], 'abs');
		$expected = ['a', 'b', 'c'];
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\map($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\map expects iterable or stdClass or null but was given $type",
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
			[2, 4, 6],
			Dash\map(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
				return $value * 2;
			})
		);

		$data = [
			'jdoe' => ['name' => ['first' => 'John', 'last' => 'Doe']],
			'mjane' => ['name' => ['first' => 'Mary', 'last' => 'Jane']],
			'psmith' => ['name' => ['first' => 'Pete', 'last' => 'Smith']],
		];
		$this->assertSame(['Doe', 'Jane', 'Smith'], Dash\map($data, 'name.last'));
	}
}
