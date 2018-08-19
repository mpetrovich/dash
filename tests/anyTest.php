<?php

/**
 * @covers Dash\any
 * @covers Dash\Curry\any
 * @covers Dash\some
 * @covers Dash\Curry\some
 */
class anyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertSame($expected, Dash\any($iterable, $predicate));
		$this->assertSame($expected, Dash\some($iterable, $predicate));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $predicate, $expected)
	{
		$any = Dash\Curry\any($predicate);
		$this->assertSame($expected, $any($iterable));

		$some = Dash\Curry\some($predicate);
		$this->assertSame($expected, $some($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an empty array' => [
				'iterable' => [],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],

			/*
				With indexed array
			 */

			'With an indexed array with no elements that satisfy the predicate' => [
				'iterable' => [2, 4, 6, 8],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an indexed array with one element that satisfies the predicate' => [
				'iterable' => [2, 4, 5, 6],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an indexed array with several elements that satisfy the predicate' => [
				'iterable' => [1, 3, 4, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an indexed array with all elements that satisfy the predicate' => [
				'iterable' => [1, 3, 5, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],

			/*
				With associative array
			 */

			'With an associative array with no elements that satisfy the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an associative array with one element that satisfies the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an associative array with several elements that satisfy the predicate' => [
				'iterable' => ['a' => 1, 'b' => 3, 'c' => 4, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an associative array with all elements that satisfy the predicate' => [
				'iterable' => ['a' => 1, 'b' => 3, 'c' => 5, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an stdClass with no elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 4, 'c' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an stdClass with one element that satisfies the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 3, 'c' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an stdClass with several elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 1, 'b' => 4, 'c' => 5],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an stdClass with all elements that satisfy the predicate' => [
				'iterable' => (object) ['a' => 1, 'b' => 3, 'c' => 5],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an ArrayObject with no elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 4, 'c' => 6]),
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an ArrayObject with one element that satisfies the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 3, 'c' => 6]),
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an ArrayObject with several elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 4, 'c' => 5]),
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],
			'With an ArrayObject with all elements that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 3, 'c' => 5]),
				'predicate' => 'Dash\isOdd',
				'expected' => true,
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
			return false;
		};

		$result = Dash\any($iterable, $predicate);

		$this->assertFalse($result);
		$this->assertSame($iterable, $iterated);
	}

	public function testShortCircuiting()
	{
		$iterated = [];

		$predicate = function ($value, $key) use (&$iterated) {
			$iterated[$key] = $value;
			return $value >= 2;
		};

		$iterable = [1, 2, 3, 4];
		$result = Dash\any($iterable, $predicate);

		$this->assertTrue($result);
		$this->assertSame([1, 2], $iterated);
	}

	/**
	 * @dataProvider casesDefaultPredicate
	 */
	public function testDefaultPredicate($iterable, $expected)
	{
		$this->assertSame($expected, Dash\any($iterable));
		$this->assertSame($expected, Dash\some($iterable));
	}

	public function casesDefaultPredicate()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => false,
			],
			'With an array of truthy values' => [
				'iterable' => [1, true, 'hello'],
				'expected' => true,
			],
			'With an array of falsey values' => [
				'iterable' => [0, false, ''],
				'expected' => false,
			],
			'With an array of values with mixed truthiness' => [
				'iterable' => [0, 1, true],
				'expected' => true,
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
			Dash\any($iterable);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\any expects iterable or stdClass or null but was given $type", $e->getMessage());
			throw $e;
		}

		try {
			Dash\some($iterable);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\any expects iterable or stdClass or null but was given $type", $e->getMessage());
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
		$this->assertSame(true, Dash\any([1, 2, 3], 'Dash\isEven'));
		$this->assertSame(false, Dash\any([1, 2, 3], function ($n) { return $n > 5; }));
		$this->assertSame(false, Dash\any([], 'Dash\isOdd'));
		$this->assertSame(true, Dash\any((object) ['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isEven'));
		$this->assertSame(true, Dash\any([false, true, true]));
		$this->assertSame(false, Dash\any([false, false, false]));
	}
}
