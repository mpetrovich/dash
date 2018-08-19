<?php

/**
 * @covers Dash\deltas
 * @covers Dash\_deltas
 */
class deltasTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\deltas($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$deltas = Dash\_deltas();
		$this->assertSame($expected, $deltas($iterable));
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
				'expected' => [0],
			],
			'With an indexed array' => [
				'iterable' => [3, 8, 9, 9, 5, 13],
				'expected' => [0, 5, 1, 0, -4, 8],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => [0],
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 8, 'c' => 9, 'd' => 9, 'e' => 5, 'f' => 13],
				'expected' => [0, 5, 1, 0, -4, 8],
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
				'expected' => [0],
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 3, 'b' => 8, 'c' => 9, 'd' => 9, 'e' => 5, 'f' => 13],
				'expected' => [0, 5, 1, 0, -4, 8],
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
				'expected' => [0],
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 9, 'd' => 9, 'e' => 5, 'f' => 13]),
				'expected' => [0, 5, 1, 0, -4, 8],
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
			Dash\deltas($iterable);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\deltas expects iterable or stdClass or null but was given $type",
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
			[0, 5, 1, 0, -4, 8],
			Dash\deltas([3, 8, 9, 9, 5, 13])
		);
	}
}
