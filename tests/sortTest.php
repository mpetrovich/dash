<?php

/**
 * @covers Dash\sort
 * @covers Dash\Curry\sort
 */
class sortTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$original = $iterable;
		$this->assertSame($expected, Dash\sort($iterable));
		$this->assertSame($original, $iterable, 'Original iterable should not be modified');
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$sort = Dash\Curry\sort('Dash\compare');
		$this->assertSame($expected, $sort($iterable));
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
				'expected' => [3],
			],
			'With an indexed array' => [
				'iterable' => [3, 8, 2, 5],
				'expected' => [2, 3, 5, 8],
			],
			'With an indexed array containing floats' => [
				'iterable' => [3.2, 3.1, 2.9, 3.0],
				'expected' => [2.9, 3.0, 3.1, 3.2],
			],
			'With an indexed array containing strings' => [
				'iterable' => ['d', 'a', 'c', 'b'],
				'expected' => ['a', 'b', 'c', 'd'],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => ['a' => 3],
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 1, 'c' => 2],
				'expected' => ['b' => 1, 'c' => 2, 'a' => 3],
			],
			'With an associative array containing floats' => [
				'iterable' => ['a' => 3.2, 'b' => 3.1, 'c' => 2.9, 'd' => 3.0],
				'expected' => ['c' => 2.9, 'd' => 3.0, 'b' => 3.1, 'a' => 3.2],
			],
			'With an associative array containing strings' => [
				'iterable' => ['three' => 'delta', 'four' => 'gamma', 'two' => 'beta', 'one' => 'alpha'],
				'expected' => ['one' => 'alpha', 'two' => 'beta', 'three' => 'delta', 'four' => 'gamma'],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => [],
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['a' => 3],
				'expected' => ['a' => 3],
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 3, 'b' => 1, 'c' => 2],
				'expected' => ['b' => 1, 'c' => 2, 'a' => 3],
			],
			'With an stdClass containing floats' => [
				'iterable' => (object) ['a' => 3.2, 'b' => 3.1, 'c' => 2.9, 'd' => 3.0],
				'expected' => ['c' => 2.9, 'd' => 3.0, 'b' => 3.1, 'a' => 3.2],
			],
			'With an stdClass array containing strings' => [
				'iterable' => (object) ['three' => 'delta', 'four' => 'gamma', 'two' => 'beta', 'one' => 'alpha'],
				'expected' => ['one' => 'alpha', 'two' => 'beta', 'three' => 'delta', 'four' => 'gamma'],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => [],
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'expected' => ['a' => 3],
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 1, 'c' => 2]),
				'expected' => ['b' => 1, 'c' => 2, 'a' => 3],
			],
			'With an ArrayObject containing floats' => [
				'iterable' => new ArrayObject(['a' => 3.2, 'b' => 3.1, 'c' => 2.9, 'd' => 3.0]),
				'expected' => ['c' => 2.9, 'd' => 3.0, 'b' => 3.1, 'a' => 3.2],
			],
			'With an ArrayObject array containing strings' => [
				'iterable' => new ArrayObject(['three' => 'delta', 'four' => 'gamma', 'two' => 'beta', 'one' => 'alpha']),
				'expected' => ['one' => 'alpha', 'two' => 'beta', 'three' => 'delta', 'four' => 'gamma'],
			],
		];
	}

	public function testComparatorArgs()
	{
		$comparator = function ($a, $b) {
			return $b - $a;
		};
		$this->assertSame([4, 3, 2, 1], Dash\sort([1, 2, 3, 4], $comparator));
	}

	/**
	 * @dataProvider casesTypeAssertions
	 */
	public function testTypeAssertions($iterable, $type)
	{
		$this->expectException(InvalidArgumentException::class);

		try {
			Dash\sort($iterable);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\sort expects iterable or stdClass or null but was given $type",
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
		$this->assertSame([1, 2, 3, 4], Dash\sort([4, 2, 3, 1]));
		$this->assertSame(['b' => 1, 'c' => 2, 'a' => 3], Dash\sort(['a' => 3, 'b' => 1, 'c' => 2]));
	}
}
