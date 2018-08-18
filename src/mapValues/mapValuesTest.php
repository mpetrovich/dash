<?php

/**
 * @covers Dash\mapValues
 * @covers Dash\_mapValues
 */
class mapValuesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$iteratee = function ($value) {
			return $value * 2;
		};
		$this->assertSame($expected, Dash\mapValues($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$iteratee = function ($value) {
			return $value * 2;
		};
		$mapValues = Dash\_mapValues($iteratee);
		$this->assertEquals($expected, $mapValues($iterable));
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
				'iterable' => [3, 1, 2, 4],
				'expected' => [6, 2, 4, 8],
			],
			'With an indexed array with several elements' => [
				'iterable' => [3],
				'expected' => [6],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['c' => 3],
				'expected' => ['c' => 6],
			],
			'With an associative array with several elements' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => ['c' => 6, 'a' => 2, 'b' => 4, 'd' => 8],
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
				'expected' => ['c' => 6],
			],
			'With an stdClass with several elements' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
				'expected' => ['c' => 6, 'a' => 2, 'b' => 4, 'd' => 8],
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
				'expected' => ['c' => 6],
			],
			'With an ArrayObject with several elements' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4]),
				'expected' => ['c' => 6, 'a' => 2, 'b' => 4, 'd' => 8],
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

		$result = Dash\mapValues($iterable, $iteratee);

		$this->assertSame(['a' => 2, 'b' => 4, 'c' => 6], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);
	}

	/**
	 * @dataProvider casesDefaultIteratee
	 */
	public function testDefaultIteratee($iterable, $expected)
	{
		$this->assertSame($expected, Dash\mapValues($iterable));
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
				'expected' => ['c' => 3, 'a' => 1, 'b' => 2, 'd' => 4],
			],
			'With an array of objects' => [
				'iterable' => ['a' => $a, 'b' => $b, 'c' => $c],
				'expected' => ['a' => $a, 'b' => $b, 'c' => $c]
			],
		];
	}

	/**
	 * @dataProvider casesWithPath
	 */
	public function testWithPath($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\mapValues($iterable, $iteratee));
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
				'expected' => ['w' => 'first', 'x' => null, 'y' => 'third', 'z' => 'fourth'],
			],
			'With a numeric iteratee' => [
				'iterable' => [
					'w' => ['one', 'two', 'three', 'four'],
					'x' => ['uno', 'dos', 'tres', 'cuatro'],
					'y' => ['un', 'deux', 'trois', 'quatre'],
				],
				'iteratee' => 2,
				'expected' => ['w' => 'three', 'x' => 'tres', 'y' => 'trois'],
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
		$actual = Dash\mapValues([
			'w' => ['abs' => 'a'],
			'x' => ['abs' => 'b'],
			'y' => ['abs' => 'c'],
		], 'abs');
		$expected = ['w' => 'a', 'x' => 'b', 'y' => 'c'];
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\mapValues($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\mapValues expects iterable or stdClass or null but was given $type",
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
			['a' => 2, 'b' => 4, 'c' => 6],
			Dash\mapValues(['a' => 1, 'b' => 2, 'c' => 3], function ($value) {
				return $value * 2;
			})
		);

		$data = [
			'jdoe' => ['name' => ['first' => 'John', 'last' => 'Doe']],
			'mjane' => ['name' => ['first' => 'Mary', 'last' => 'Jane']],
			'psmith' => ['name' => ['first' => 'Pete', 'last' => 'Smith']],
		];
		$this->assertSame(
			['jdoe' => 'Doe', 'mjane' => 'Jane', 'psmith' => 'Smith'],
			Dash\mapValues($data, 'name.last')
		);
	}
}
