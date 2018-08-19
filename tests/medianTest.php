<?php

/**
 * @covers Dash\median
 * @covers Dash\Curry\median
 */
class medianTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\median($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$median = Dash\Curry\median();
		$this->assertSame($expected, $median($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'expected' => null,
			],
			'With an empty array' => [
				'iterable' => [],
				'expected' => null,
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'expected' => 3,
			],
			'With an indexed array with an odd number of elements' => [
				'iterable' => [2, 1, 5, 3, 4],
				'expected' => 3,
			],
			'With an indexed array with an even number of elements' => [
				'iterable' => [2, 1, 3, 4],
				'expected' => 2.5,
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => 3,
			],
			'With an associative with an odd number of elements' => [
				'iterable' => ['a' => 2, 'b' => 1, 'c' => 5, 'd' => 3, 'e' => 4],
				'expected' => 3,
			],
			'With an associative array with an even number of elements' => [
				'iterable' => ['a' => 2, 'b' => 1, 'c' => 3, 'd' => 4],
				'expected' => 2.5,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => null,
			],
			'With an stdClass with an odd number of elements' => [
				'iterable' => (object) ['a' => 2, 'b' => 1, 'c' => 5, 'd' => 3, 'e' => 4],
				'expected' => 3,
			],
			'With an stdClass array with an even number of elements' => [
				'iterable' => (object) ['a' => 2, 'b' => 1, 'c' => 3, 'd' => 4],
				'expected' => 2.5,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => null,
			],
			'With an ArrayObject with an odd number of elements' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 1, 'c' => 5, 'd' => 3, 'e' => 4]),
				'expected' => 3,
			],
			'With an ArrayObject array with an even number of elements' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 1, 'c' => 3, 'd' => 4]),
				'expected' => 2.5,
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
			Dash\median($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\median expects iterable or stdClass or null but was given $type",
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
		$this->assertSame(3, Dash\median([3, 2, 1, 5, 4]));
		$this->assertSame(2.5, Dash\median([3, 2, 1, 4]));
	}
}
