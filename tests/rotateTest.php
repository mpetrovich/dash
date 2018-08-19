<?php

/**
 * @covers Dash\rotate
 * @covers Dash\Curry\rotate
 */
class rotateTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertSame($expected, Dash\rotate($iterable, $count));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $count, $expected)
	{
		$rotate = Dash\Curry\rotate($count);
		$this->assertSame($expected, $rotate($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'count' => 1,
				'expected' => [],
			],

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'count' => 1,
				'expected' => [],
			],
			'With an indexed array with one element' => [
				'iterable' => ['a'],
				'count' => 1,
				'expected' => ['a'],
			],
			'With an indexed array' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'count' => 1,
				'expected' => ['b', 'c', 'd', 'a'],
			],
			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'count' => 1,
				'expected' => ['a' => 3],
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'count' => 1,
				'expected' => ['b' => 8, 'c' => 2, 'd' => 5, 'a' => 3],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 0,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 1,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 3,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 5,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 6,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -1,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -3,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -5,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -6,
				'expected' => [3, 4, 1, 2],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'count' => 1,
				'expected' => [],
			],
			'With an stdClass of an indexed array with one element' => [
				'iterable' => (object) ['a'],
				'count' => 1,
				'expected' => ['a'],
			],
			'With an stdClass of an indexed array' => [
				'iterable' => (object) ['a', 'b', 'c', 'd'],
				'count' => 1,
				'expected' => ['b', 'c', 'd', 'a'],
			],
			'With an stdClass of an associative array with one element' => [
				'iterable' => (object) ['a' => 3],
				'count' => 1,
				'expected' => ['a' => 3],
			],
			'With an stdClass of an associative array' => [
				'iterable' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'count' => 1,
				'expected' => ['b' => 8, 'c' => 2, 'd' => 5, 'a' => 3],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 0,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 1,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 3,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 5,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 6,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -1,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -3,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -5,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -6,
				'expected' => [3, 4, 1, 2],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'count' => 1,
				'expected' => [],
			],
			'With an ArrayObject of an indexed array with one element' => [
				'iterable' => new ArrayObject(['a']),
				'count' => 1,
				'expected' => ['a'],
			],
			'With an ArrayObject of an indexed array' => [
				'iterable' => new ArrayObject(['a', 'b', 'c', 'd']),
				'count' => 1,
				'expected' => ['b', 'c', 'd', 'a'],
			],
			'With an ArrayObject of an associative array with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'count' => 1,
				'expected' => ['a' => 3],
			],
			'With an ArrayObject of an associative array' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'count' => 1,
				'expected' => ['b' => 8, 'c' => 2, 'd' => 5, 'a' => 3],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 0,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 1,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 3,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 5,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 6,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -1,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -2,
				'expected' => [3, 4, 1, 2],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -3,
				'expected' => [2, 3, 4, 1],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -5,
				'expected' => [4, 1, 2, 3],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -6,
				'expected' => [3, 4, 1, 2],
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
			Dash\rotate($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\rotate expects iterable or stdClass or null but was given $type",
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
		$this->assertSame(['c', 'd', 'e', 'a', 'b'], Dash\rotate(['a', 'b', 'c', 'd', 'e'], 2));
		$this->assertSame(['b' => 2, 'c' => 3, 'a' => 1], Dash\rotate(['a' => 1, 'b' => 2, 'c' => 3], 1));
		$this->assertSame(['e', 'a', 'b', 'c', 'd'], Dash\rotate(['a', 'b', 'c', 'd', 'e'], -1));
	}
}
