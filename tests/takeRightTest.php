<?php

/**
 * @covers Dash\takeRight
 * @covers Dash\Curry\takeRight
 */
class takeRightTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertEquals($expected, Dash\takeRight($iterable, $count));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $count, $expected)
	{
		$takeRight = Dash\Curry\takeRight($count);
		$this->assertEquals($expected, $takeRight($iterable));
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
				'count' => 2,
				'expected' => ['a'],
			],
			'With an indexed array' => [
				'iterable' => ['a', 'b', 'c', 'd'],
				'count' => 2,
				'expected' => ['c', 'd'],
			],
			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'count' => 2,
				'expected' => ['a' => 3],
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'count' => 2,
				'expected' => ['c' => 2, 'd' => 5],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 0,
				'expected' => [],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 1,
				'expected' => [4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 2,
				'expected' => [3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 3,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => 5,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -1,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -2,
				'expected' => [3, 4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -3,
				'expected' => [4],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -4,
				'expected' => [],
			],
			[
				'iterable' => [1, 2, 3, 4],
				'count' => -5,
				'expected' => [],
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
				'count' => 2,
				'expected' => ['a'],
			],
			'With an stdClass of an indexed array' => [
				'iterable' => (object) ['a', 'b', 'c', 'd'],
				'count' => 2,
				'expected' => ['c', 'd'],
			],
			'With an stdClass of an associative array with one element' => [
				'iterable' => (object) ['a' => 3],
				'count' => 2,
				'expected' => ['a' => 3],
			],
			'With an stdClass of an associative array' => [
				'iterable' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'count' => 2,
				'expected' => ['c' => 2, 'd' => 5],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 0,
				'expected' => [],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 1,
				'expected' => [4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 2,
				'expected' => [3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 3,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => 5,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -1,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -2,
				'expected' => [3, 4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -3,
				'expected' => [4],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -4,
				'expected' => [],
			],
			[
				'iterable' => (object) [1, 2, 3, 4],
				'count' => -5,
				'expected' => [],
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
				'count' => 2,
				'expected' => ['a'],
			],
			'With an ArrayObject of an indexed array' => [
				'iterable' => new ArrayObject(['a', 'b', 'c', 'd']),
				'count' => 2,
				'expected' => ['c', 'd'],
			],
			'With an ArrayObject of an associative array with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'count' => 2,
				'expected' => ['a' => 3],
			],
			'With an ArrayObject of an associative array' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'count' => 2,
				'expected' => ['c' => 2, 'd' => 5],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 0,
				'expected' => [],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 1,
				'expected' => [4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 2,
				'expected' => [3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 3,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 4,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => 5,
				'expected' => [1, 2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -1,
				'expected' => [2, 3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -2,
				'expected' => [3, 4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -3,
				'expected' => [4],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -4,
				'expected' => [],
			],
			[
				'iterable' => new ArrayObject([1, 2, 3, 4]),
				'count' => -5,
				'expected' => [],
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
			Dash\takeRight($iterable);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\takeRight expects iterable or stdClass or null but was given $type",
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
		$this->assertSame([5, 8, 13], Dash\takeRight([2, 3, 5, 8, 13], 3));
		$this->assertSame(['c' => 3, 'a' => 1], Dash\takeRight(['b' => 2, 'c' => 3, 'a' => 1], 2));
		$this->assertSame([3, 4, 5, 6], Dash\takeRight([1, 2, 3, 4, 5, 6], -2));
	}
}
