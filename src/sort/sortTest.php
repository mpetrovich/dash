<?php

/**
 * @covers Dash\sort
 * @covers Dash\_sort
 */
class sortTest extends PHPUnit_Framework_TestCase
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
		$sort = Dash\_sort('Dash\compare');
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
		];
	}

	public function testComparatorArgs()
	{
		$comparator = function ($a, $b) { return $b - $a; };
		$this->assertSame([4, 3, 2, 1], Dash\sort([1, 2, 3, 4], $comparator));
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\sort($iterable);
		}
		catch (Exception $e) {
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
