<?php

/**
 * @covers Dash\sum
 * @covers Dash\Curry\sum
 */
class sumTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\sum($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$sum = Dash\Curry\sum();
		$this->assertSame($expected, $sum($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'expected' => 0,
			],
			'With an empty array' => [
				'iterable' => [],
				'expected' => 0,
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'expected' => 3,
			],
			'With an indexed array' => [
				'iterable' => [2, 3, 5, 8],
				'expected' => 18,
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => 3,
			],
			'With an associative array' => [
				'iterable' => ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 18,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => 0,
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['a' => 3],
				'expected' => 3,
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 18,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => 0,
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'expected' => 3,
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8]),
				'expected' => 18,
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
			Dash\sum($iterable);
		} catch (Exception $e) {
			$this->assertSame("Dash\\sum expects iterable or stdClass or null but was given $type", $e->getMessage());
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
		$this->assertSame(18, Dash\sum([2, 3, 5, 8]));
		$this->assertSame(0, Dash\sum([]));
	}
}
