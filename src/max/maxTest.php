<?php

/**
 * @covers Dash\max
 * @covers Dash\_max
 */
class maxTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\max($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$max = Dash\_max();
		$this->assertEquals($expected, $max($iterable));
	}

	public function cases()
	{
		return [

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
			'With an indexed array' => [
				'iterable' => [3, 8, 2, 5],
				'expected' => 8,
			],
			'With an indexed array containing INF as the maximum' => [
				'iterable' => [-INF, -INF, -INF],
				'expected' => -INF,
			],
			'With an indexed array containing -INF but not as the maximum' => [
				'iterable' => [-INF, -INF, 2],
				'expected' => 2,
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => 3,
			],
			'With an associative array' => [
				'iterable' => ['a' => 3, 'b' => 2, 'c' => 8, 'd' => 5],
				'expected' => 8,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => null,
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['a' => 3],
				'expected' => 3,
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 3, 'b' => 2, 'c' => 8, 'd' => 5],
				'expected' => 8,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => null,
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'expected' => 3,
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 3, 'b' => 2, 'c' => 8, 'd' => 5]),
				'expected' => 8,
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
			Dash\max($iterable);
		}
		catch (Exception $e) {
			$this->assertEquals("Dash\max expects iterable but was given $type", $e->getMessage());
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
}
