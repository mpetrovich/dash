<?php

/**
 * @covers Dash\keys
 * @covers Dash\_keys
 */
class keysTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\keys($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$keys = Dash\_keys();
		$this->assertSame($expected, $keys($iterable));
	}

	public function cases()
	{
		return [
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
				'iterable' => [3, 8, 2, 5],
				'expected' => [0, 1, 2, 3],
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => ['a'],
			],
			'With an associative array' => [
				'iterable' => ['c' => 3, 'a' => 1, 'b' => 2],
				'expected' => ['c', 'a', 'b'],
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
				'expected' => ['a'],
			],
			'With an stdClass' => [
				'iterable' => (object) ['c' => 3, 'a' => 1, 'b' => 2],
				'expected' => ['c', 'a', 'b'],
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
				'expected' => ['a'],
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['c' => 3, 'a' => 1, 'b' => 2]),
				'expected' => ['c', 'a', 'b'],
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
			Dash\keys($iterable);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\keys expects iterable or stdClass but was given $type", $e->getMessage());
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

	public function testExamples()
	{
		$this->assertSame(['c', 'a', 'b'], Dash\keys(['c' => 3, 'a' => 1, 'b' => 2]));
	}
}
