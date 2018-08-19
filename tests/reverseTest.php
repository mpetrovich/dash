<?php

/**
 * @covers Dash\reverse
 * @covers Dash\Curry\reverse
 */
class reverseTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $preserveIntegerKeys, $expected)
	{
		$this->assertSame($expected, Dash\reverse($iterable, $preserveIntegerKeys));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $preserveIntegerKeys, $expected)
	{
		$reverse = Dash\Curry\reverse($preserveIntegerKeys);
		$this->assertSame($expected, $reverse($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'preserveIntegerKeys' => false,
				'expected' => [],
			],
			'With null (integer keys preserved)' => [
				'iterable' => null,
				'preserveIntegerKeys' => true,
				'expected' => [],
			],

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'preserveIntegerKeys' => false,
				'expected' => [],
			],
			'With an empty array (integer keys preserved)' => [
				'iterable' => [],
				'preserveIntegerKeys' => true,
				'expected' => [],
			],
			'With an indexed array' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'preserveIntegerKeys' => false,
				'expected' => ['d', 'c', 'b', 'a'],
			],
			'With an indexed array (integer keys preserved)' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'preserveIntegerKeys' => true,
				'expected' => [3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a'],
			],
			'With an indexed array with one element' => [
				'iterable' => ['a'],
				'preserveIntegerKeys' => false,
				'expected' => ['a'],
			],
			'With an indexed array with one element (integer keys preserved)' => [
				'iterable' => ['a'],
				'preserveIntegerKeys' => true,
				'expected' => [0 => 'a'],
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'preserveIntegerKeys' => false,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an associative array (integer keys preserved)' => [
				'iterable' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'preserveIntegerKeys' => true,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'preserveIntegerKeys' => false,
				'expected' => ['a' => 3],
			],
			'With an associative array with one element (integer keys preserved)' => [
				'iterable' => ['a' => 3],
				'preserveIntegerKeys' => true,
				'expected' => ['a' => 3],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'preserveIntegerKeys' => false,
				'expected' => [],
			],
			'With an empty stdClass (integer keys preserved)' => [
				'iterable' => (object) [],
				'preserveIntegerKeys' => true,
				'expected' => [],
			],
			'With an stdClass of an indexed array' => [
				'iterable' => (object) ['a', 'b', 'c', 'd'],
				'preserveIntegerKeys' => false,
				'expected' => ['d', 'c', 'b', 'a'],
			],
			'With an stdClass of an indexed array (integer keys preserved)' => [
				'iterable' => (object) ['a', 'b', 'c', 'd'],
				'preserveIntegerKeys' => true,
				'expected' => [3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a'],
			],
			'With an stdClass of an indexed array with one element' => [
				'iterable' => (object) ['a'],
				'preserveIntegerKeys' => false,
				'expected' => ['a'],
			],
			'With an stdClass of an indexed array with one element (integer keys preserved)' => [
				'iterable' => (object) ['a'],
				'preserveIntegerKeys' => true,
				'expected' => [0 => 'a'],
			],
			'With an stdClass of an associative array' => [
				'iterable' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'preserveIntegerKeys' => false,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an stdClass of an associative array (integer keys preserved)' => [
				'iterable' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'preserveIntegerKeys' => true,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an stdClass of an associative array with one element' => [
				'iterable' => (object) ['a' => 3],
				'preserveIntegerKeys' => false,
				'expected' => ['a' => 3],
			],
			'With an stdClass of an associative array with one element (integer keys preserved)' => [
				'iterable' => (object) ['a' => 3],
				'preserveIntegerKeys' => true,
				'expected' => ['a' => 3],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'preserveIntegerKeys' => false,
				'expected' => [],
			],
			'With an empty ArrayObject (integer keys preserved)' => [
				'iterable' => new ArrayObject([]),
				'preserveIntegerKeys' => true,
				'expected' => [],
			],
			'With an ArrayObject of an indexed array' => [
				'iterable' => new ArrayObject(['a', 'b', 'c', 'd']),
				'preserveIntegerKeys' => false,
				'expected' => ['d', 'c', 'b', 'a'],
			],
			'With an ArrayObject of an indexed array (integer keys preserved)' => [
				'iterable' => new ArrayObject(['a', 'b', 'c', 'd']),
				'preserveIntegerKeys' => true,
				'expected' => [3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a'],
			],
			'With an ArrayObject of an indexed array with one element' => [
				'iterable' => new ArrayObject(['a']),
				'preserveIntegerKeys' => false,
				'expected' => ['a'],
			],
			'With an ArrayObject of an indexed array with one element (integer keys preserved)' => [
				'iterable' => new ArrayObject(['a']),
				'preserveIntegerKeys' => true,
				'expected' => [0 => 'a'],
			],
			'With an ArrayObject of an associative array' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'preserveIntegerKeys' => false,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an ArrayObject of an associative array (integer keys preserved)' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'preserveIntegerKeys' => true,
				'expected' => ['d' => 5, 'c' => 2, 'b' => 8, 'a' => 3],
			],
			'With an ArrayObject of an associative array with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'preserveIntegerKeys' => false,
				'expected' => ['a' => 3],
			],
			'With an ArrayObject of an associative array with one element (integer keys preserved)' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'preserveIntegerKeys' => true,
				'expected' => ['a' => 3],
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
			Dash\reverse($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\reverse expects iterable or stdClass or null but was given $type",
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
		$this->assertSame(['c', 'b', 'a'], Dash\reverse(['a', 'b', 'c']));
		$this->assertSame(['c' => 3, 'b' => 2, 'a' => 1], Dash\reverse(['a' => 1, 'b' => 2, 'c' => 3]));
		$this->assertSame([2 => 'c', 1 => 'b', 0 => 'a'], Dash\reverse(['a', 'b', 'c'], true));
		$this->assertSame([0 => 'c', 1 => 'b', 2 => 'a'], Dash\reverse(['a', 'b', 'c'], false));
	}
}
