<?php

/**
 * @covers Dash\join
 * @covers Dash\Curry\join
 * @covers Dash\implode
 * @covers Dash\Curry\implode
 */
class joinTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $separator, $expected)
	{
		$this->assertSame($expected, Dash\join($iterable, $separator));
		$this->assertSame($expected, Dash\implode($iterable, $separator));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $separator, $expected)
	{
		$join = Dash\Curry\join($separator);
		$this->assertSame($expected, $join($iterable));

		$implode = Dash\Curry\implode($separator);
		$this->assertSame($expected, $implode($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'separator' => ', ',
				'expected' => '',
			],
			'With an empty array' => [
				'iterable' => [],
				'separator' => ', ',
				'expected' => '',
			],
			'With an empty separator' => [
				'iterable' => [1, 2, 3],
				'separator' => '',
				'expected' => '123',
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'separator' => ', ',
				'expected' => '3',
			],
			'With an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'separator' => ', ',
				'expected' => '1, 2, 3, 4',
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'separator' => ', ',
				'expected' => '3',
			],
			'With an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'separator' => ', ',
				'expected' => '1, 2, 3, 4',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'separator' => ', ',
				'expected' => '',
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['a' => 3],
				'separator' => ', ',
				'expected' => '3',
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'separator' => ', ',
				'expected' => '1, 2, 3, 4',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'separator' => ', ',
				'expected' => '',
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'separator' => ', ',
				'expected' => '3',
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'separator' => ', ',
				'expected' => '1, 2, 3, 4',
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
			Dash\join($iterable, ', ');
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\join expects iterable or stdClass or null but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesIterableTypeAssertions()
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

	/**
	 * @dataProvider casesSeparatorTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testSeparatorTypeAssertions($separator, $type)
	{
		try {
			Dash\join([1, 2, 3], $separator);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\join expects string but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesSeparatorTypeAssertions()
	{
		return [
			'With null' => [
				'separator' => null,
				'type' => 'NULL',
			],
			'With a zero number' => [
				'separator' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'separator' => 3,
				'type' => 'integer',
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame('123-456-789', Dash\join([123, 456, 789], '-'));
		$this->assertSame('1, 2, 3', Dash\join(['a' => 1, 'b' => 2, 'c' => 3], ', '));
	}
}
