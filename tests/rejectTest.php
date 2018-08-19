<?php

/**
 * @covers Dash\reject
 * @covers Dash\Curry\reject
 */
class rejectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\reject($iterable, $predicate));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $predicate, $expected)
	{
		$reject = Dash\Curry\reject($predicate);
		$this->assertEquals($expected, $reject($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with no elements that satisfy the predicate' => [
				'iterable' => [2, 4, 6, 8],
				'predicate' => 'Dash\isOdd',
				'expected' => [2, 4, 6, 8],
			],
			'With an indexed array with one element that satisfies the predicate' => [
				'iterable' => [2, 4, 5, 6],
				'predicate' => 'Dash\isOdd',
				'expected' => [2, 4, 6],
			],
			'With an indexed array with several elements that satisfy the predicate' => [
				'iterable' => [1, 3, 4, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => [4],
			],
			'With an indexed array with all elements that satisfy the predicate' => [
				'iterable' => [1, 3, 5, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an indexed array and matchesProperty($field) shorthand' => [
				'iterable' => [
					['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => 'active',
				'expected' => [
					['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
				],
			],
			'With an indexed array and matchesProperty($field, $value) shorthand' => [
				'iterable' => [
					['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => ['active', false],
				'expected' => [
					['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
			],

			/*
				With associative array
			 */

			'With an associative array with no elements that satisfy the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
			],
			'With an associative array with one element that satisfies the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'd' => 6],
			],
			'With an associative array with several elements that satisfy the predicate' => [
				'iterable' => ['a' => 1, 'b' => 3, 'c' => 4, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => ['c' => 4],
			],
			'With an associative array with all elements that satisfy the predicate' => [
				'iterable' => ['a' => 1, 'b' => 3, 'c' => 5, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an associative array and matchesProperty($field) shorthand' => [
				'iterable' => [
					'a' => ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'b' => ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'c' => ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					'd' => ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => 'active',
				'expected' => [
					'a' => ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'c' => ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
				],
			],
			'With an associative array and matchesProperty($field, $value) shorthand' => [
				'iterable' => [
					'a' => ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'b' => ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'c' => ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					'd' => ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => ['active', false],
				'expected' => [
					'b' => ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'd' => ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an stdClass with no elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
			],
			'With an stdClass with one element that satisfies the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'd' => 6],
			],
			'With an stdClass with several elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 1, 'b' => 3, 'c' => 4, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => ['c' => 4],
			],
			'With an stdClass with all elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 1, 'b' => 3, 'c' => 5, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an stdClass and matchesProperty($field) shorthand' => [
				'iterable' => (object) [
					'a' => (object) ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'b' => (object) ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'c' => (object) ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					'd' => (object) ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => 'active',
				'expected' => [
					'a' => (object) ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'c' => (object) ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
				],
			],
			'With an stdClass and matchesProperty($field, $value) shorthand' => [
				'iterable' => (object) [
					'a' => (object) ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'b' => (object) ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'c' => (object) ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					'd' => (object) ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => ['active', false],
				'expected' => [
					'b' => (object) ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'd' => (object) ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an ArrayObject with no elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8]),
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
			],
			'With an ArrayObject with one element that satisfies the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6]),
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 2, 'b' => 4, 'd' => 6],
			],
			'With an ArrayObject with several elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 3, 'c' => 4, 'd' => 7]),
				'predicate' => 'Dash\isOdd',
				'expected' => ['c' => 4],
			],
			'With an ArrayObject with all elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 3, 'c' => 5, 'd' => 7]),
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an ArrayObject and matchesProperty($field) shorthand' => [
				'iterable' => new ArrayObject([
					'a' => new ArrayObject(['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false]),
					'b' => new ArrayObject(['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true]),
					'c' => new ArrayObject(['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false]),
					'd' => new ArrayObject(['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true]),
				]),
				'predicate' => 'active',
				'expected' => [
					'a' => new ArrayObject(['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false]),
					'c' => new ArrayObject(['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false]),
				],
			],
			'With an ArrayObject and matchesProperty($field, $value) shorthand' => [
				'iterable' => new ArrayObject([
					'a' => new ArrayObject(['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false]),
					'b' => new ArrayObject(['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true]),
					'c' => new ArrayObject(['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false]),
					'd' => new ArrayObject(['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true]),
				]),
				'predicate' => ['active', false],
				'expected' => [
					'b' => new ArrayObject(['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true]),
					'd' => new ArrayObject(['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true]),
				],
			],
		];
	}

	public function testPredicateArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iterated = [];

		$predicate = function ($value, $key, $passedIterable) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			$this->assertSame($iterable, $passedIterable);
			return $value % 2 === 0;
		};

		$result = Dash\reject($iterable, $predicate);

		$this->assertSame(['a' => 1, 'c' => 3], $result);
		$this->assertSame($iterable, $iterated);
		$this->assertNotSame($result, $iterable);
	}

	/**
	 * @dataProvider casesDefaultPredicate
	 */
	public function testDefaultPredicate($iterable, $expected)
	{
		$this->assertSame($expected, Dash\reject($iterable));
	}

	public function casesDefaultPredicate()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => [],
			],
			'With an array of truthy values' => [
				'iterable' => [1, true, 'hello'],
				'expected' => [],
			],
			'With an array of falsey values' => [
				'iterable' => [0, false, ''],
				'expected' => [0, false, ''],
			],
			'With an array of values with mixed truthiness' => [
				'iterable' => [0, 1, true],
				'expected' => [0],
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
			Dash\reject($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\reject expects iterable or stdClass or null but was given $type",
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
		$this->assertSame([2, 4], Dash\reject([1, 2, 3, 4], 'Dash\isOdd'));
		$this->assertSame(
			[3 => 'c', 2 => 'b'],
			Dash\reject([3 => 'c', 1 => 'a', 2 => 'b'], function ($value, $key) { return $key <= 1; })
		);
		$this->assertSame([null, false], Dash\reject([1, 2, null, 3, false, true]));

		$data = [
			['name' => 'John', 'active' => false],
			['name' => 'Mary', 'active' => true],
			['name' => 'Pete', 'active' => true],
		];
		$this->assertSame(
			[
				['name' => 'John', 'active' => false],
			],
			Dash\reject($data, 'active')
		);
		$this->assertSame(
			[
				['name' => 'Mary', 'active' => true],
				['name' => 'Pete', 'active' => true]
			],
			Dash\reject($data, ['active', false])
		);
	}
}
