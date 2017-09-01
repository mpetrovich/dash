<?php

/**
 * @covers Dash\at
 * @covers Dash\_at
 */
class atTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $index, $expected)
	{
		$this->assertSame($expected, Dash\at($iterable, $index));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $index, $expected)
	{
		$at = Dash\_at($index, null);
		$this->assertSame($expected, $at($iterable));
	}

	public function cases()
	{
		return [

			'With an empty array' => [
				'iterable' => [],
				'index' => 2,
				'expected' => null,
			],

			/*
				With indexed array
			 */

			'With an indexed array' => [
				'iterable' => [2, 3, 5, 8],
				'index' => 2,
				'expected' => 5,
			],
			'With an indexed array and a numeric string index' => [
				'iterable' => [2, 3, 5, 8],
				'index' => '2',
				'expected' => 5,
			],
			'With an indexed array but an invalid index' => [
				'iterable' => [2, 3, 5, 8],
				'index' => 4,
				'expected' => null,
			],

			/*
				With associative array
			 */

			'With an associative array' => [
				'iterable' => ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'],
				'index' => 2,
				'expected' => 'three',
			],
			'With an associative array with integer keys' => [
				'iterable' => [3 => 2, 1 => 3, 0 => 5, 2 => 8],
				'index' => 2,
				'expected' => 5,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'index' => 2,
				'expected' => null,
			],
			'With an stdClass with integer keys' => [
				'iterable' => (object) [2, 3, 5, 8],
				'index' => 2,
				'expected' => 5,
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four'],
				'index' => 2,
				'expected' => 'three',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'index' => 2,
				'expected' => null,
			],
			'With an ArrayObject with integer keys' => [
				'iterable' => new ArrayObject([2, 3, 5, 8]),
				'index' => 2,
				'expected' => 5,
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 'one', 'b' => 'two', 'c' => 'three', 'd' => 'four']),
				'index' => 2,
				'expected' => 'three',
			],
		];
	}

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($iterable, $index, $default, $expected)
	{
		$this->assertSame($expected, Dash\at($iterable, $index, $default));
	}

	public function casesDefault()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'index' => 0,
				'default' => 'default',
				'expected' => 'default',
			],
			'With a negative out-of-bounds index' => [
				'iterable' => [1, 2, 3],
				'index' => -1,
				'default' => 'default',
				'expected' => 'default',
			],
			'With a valid index' => [
				'iterable' => [1, 2, 3],
				'index' => 1,
				'default' => 2,
				'expected' => 2,
			],
			'With a positive out-of-bounds index' => [
				'iterable' => [1, 2, 3],
				'index' => 3,
				'default' => 'default',
				'expected' => 'default',
			],
		];
	}

	/**
	 * @dataProvider casesIterableTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testIterableTypeAssertions($iterable, $type)
	{
		try {
			Dash\at($iterable, 0);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\at expects iterable but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesIterableTypeAssertions()
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

	/**
	 * @dataProvider casesIndexTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testIndexTypeAssertions($index, $type)
	{
		try {
			Dash\at([1, 2, 3], $index);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\at expects numeric but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesIndexTypeAssertions()
	{
		return [
			'With null' => [
				'index' => null,
				'type' => 'NULL',
			],
			'With an empty string' => [
				'index' => '',
				'type' => 'string',
			],
			'With a string' => [
				'index' => 'hello',
				'type' => 'string',
			],
			'With a DateTime' => [
				'index' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}
}
