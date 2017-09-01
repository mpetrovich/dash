<?php

/**
 * @covers Dash\all
 * @covers Dash\_all
 * @covers Dash\every
 * @covers Dash\_every
 */
class allTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\all($iterable, $predicate));
		$this->assertEquals($expected, Dash\every($iterable, $predicate));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $predicate, $expected)
	{
		$all = Dash\_all($predicate);
		$this->assertEquals($expected, $all($iterable));

		$every = Dash\_every($predicate);
		$this->assertEquals($expected, $every($iterable));
	}

	public function cases()
	{
		return [

			'With an empty array' => [
				'iterable' => [],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],

			/*
				With indexed array
			 */

			'With an indexed array with no items that satisfy the predicate' => [
				'iterable' => [2, 4, 6, 8],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an indexed array with one item that satisfies the predicate' => [
				'iterable' => [2, 4, 5, 6],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an indexed array with several items that satisfy the predicate' => [
				'iterable' => [1, 3, 4, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an indexed array with all items that satisfy the predicate' => [
				'iterable' => [1, 3, 5, 7],
				'predicate' => 'Dash\isOdd',
				'expected' => true,
			],

			/*
				With associative array
			 */

			'With an associative array with no items that satisfy the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an associative array with one item that satisfies the predicate' => [
				'iterable' => ['a' => 2, 'b' => 4, 'c' => 5, 'd' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an associative array with several items that satisfy the predicate' => [
				'iterable' => ['a' => 1, 'b' => 3, 'c' => 4, 'd' => 7],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an associative array with all items that satisfy the predicate' => [
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
				'expected' => true,
			],
			'With an stdClass with no items that satisfy the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 4, 'c' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an stdClass with one item that satisfies the predicate' => [
				'iterable' => (object) ['a' => 2, 'b' => 3, 'c' => 6],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an stdClass with several items that satisfy the predicate' => [
				'iterable' => (object) ['a' => 1, 'b' => 4, 'c' => 5],
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an stdClass with all items that satisfy the predicate' => [
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
				'expected' => true,
			],
			'With an ArrayObject with no items that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 4, 'c' => 6]),
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an ArrayObject with one item that satisfies the predicate' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 3, 'c' => 6]),
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an ArrayObject with several items that satisfy the predicate' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 4, 'c' => 5]),
				'predicate' => 'Dash\isOdd',
				'expected' => false,
			],
			'With an ArrayObject with all items that satisfy the predicate' => [
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
			return true;
		};

		$result = Dash\all($iterable, $predicate);

		$this->assertTrue($result);
		$this->assertSame($iterable, $iterated);
	}

	public function testShortCircuiting()
	{
		$iterated = [];

		$predicate = function ($value, $key) use (&$iterated) {
			$iterated[$key] = $value;
			return $value < 2;
		};

		$iterable = [1, 2, 3, 4];
		$result = Dash\all($iterable, $predicate);

		$this->assertFalse($result);
		$this->assertSame([1, 2], $iterated);
	}

	/**
	 * @dataProvider casesDefaultPredicate
	 */
	public function testDefaultPredicate($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\all($iterable));
		$this->assertEquals($expected, Dash\every($iterable));
	}

	public function casesDefaultPredicate()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'expected' => true,
			],
			'With an array of truthy values' => [
				'iterable' => [1, true, 'hello'],
				'expected' => true,
			],
			'With an array of values with mixed truthiness' => [
				'iterable' => [0, 1, true],
				'expected' => false,
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
			Dash\all($iterable);
		}
		catch (Exception $e) {
			$this->assertEquals("Dash\all expects iterable but was given $type", $e->getMessage());
			throw $e;
		}

		try {
			Dash\every($iterable);
		}
		catch (Exception $e) {
			$this->assertEquals("Dash\all expects iterable but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With null' => [
				'iterable' => null,
				'type' => 'NULL',
			],
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
