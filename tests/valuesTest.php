<?php

/**
 * @covers Dash\values
 * @covers Dash\Curry\values
 */
class valuesTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\values($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$values = Dash\Curry\values();
		$this->assertSame($expected, $values($iterable));
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
				'expected' => [3, 8, 2, 5],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => [3],
			],
			'With an associative array' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2],
				'expected' => [3, 1, 2],
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
				'expected' => [3],
			],
			'With an stdClass' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2],
				'expected' => [3, 1, 2],
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
				'expected' => [3],
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2]),
				'expected' => [3, 1, 2],
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
			Dash\values($iterable);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\values expects iterable or stdClass or null but was given $type",
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
			[3, 1, 2],
			Dash\values(['c' => 3, 'a' => 1, 'b' => 2])
		);
	}
}
