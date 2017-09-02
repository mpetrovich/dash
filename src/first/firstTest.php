<?php

/**
 * @covers Dash\first
 * @covers Dash\_first
 * @covers Dash\head
 * @covers Dash\_head
 */
class firstTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\first($iterable));
		$this->assertEquals($expected, Dash\head($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$first = Dash\_first();
		$this->assertSame($expected, $first($iterable));

		$head = Dash\_head();
		$this->assertSame($expected, $head($iterable));
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
				'iterable' => [2, 3, 5, 8],
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
				'iterable' => ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 2,
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
				'iterable' => (object) ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 2,
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
				'iterable' => new ArrayObject(['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8]),
				'expected' => 2,
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
			Dash\first($iterable);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\first expects iterable but was given $type", $e->getMessage());
			throw $e;
		}

		try {
			Dash\head($iterable);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\first expects iterable but was given $type", $e->getMessage());
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
