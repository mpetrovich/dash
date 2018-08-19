<?php

/**
 * @covers Dash\pick
 * @covers Dash\Curry\pick
 */
class pickTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $keys, $expected)
	{
		$this->assertEquals($expected, Dash\pick($iterable, $keys));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $keys, $expected)
	{
		$pick = Dash\Curry\pick($keys);
		$this->assertEquals($expected, $pick($iterable));
	}

	public function cases()
	{
		return [
			'Pick null from an empty array' => [
				'iterable' => [],
				'pick' => null,
				'expected' => [],
			],
			'Pick none from an empty array' => [
				'iterable' => [],
				'pick' => [],
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'Pick none from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'pick' => 2,
				'expected' => [3],
			],
			'Pick several from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'pick' => [0, 2],
				'expected' => [1, 3],
			],
			'Pick all from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'pick' => [0, 1, 2, 3],
				'expected' => [1, 2, 3, 4],
			],

			/*
				With associative array
			 */

			'Pick none from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => 'b',
				'expected' => ['b' => 2],
			],
			'Pick several from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => ['a', 'c'],
				'expected' => ['a' => 1, 'c' => 3],
			],
			'Pick all from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => ['a', 'b', 'c', 'd'],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
			],

			/*
				With stdClass
			 */

			'Pick none from an empty stdClass' => [
				'iterable' => (object) [],
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an empty stdClass' => [
				'iterable' => (object) [],
				'pick' => 'b',
				'expected' => [],
			],
			'Pick several from an empty stdClass' => [
				'iterable' => (object) [],
				'pick' => ['a', 'c'],
				'expected' => [],
			],
			'Pick none from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => 'b',
				'expected' => ['b' => 2],
			],
			'Pick several from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => ['a', 'c'],
				'expected' => ['a' => 1, 'c' => 3],
			],
			'Pick all from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'pick' => ['a', 'b', 'c', 'd'],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
			],

			/*
				With ArrayObject
			 */

			'Pick none from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'pick' => 'b',
				'expected' => [],
			],
			'Pick several from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'pick' => ['a', 'c'],
				'expected' => [],
			],
			'Pick none from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'pick' => [],
				'expected' => [],
			],
			'Pick one from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'pick' => 'b',
				'expected' => ['b' => 2],
			],
			'Pick several from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'pick' => ['a', 'c'],
				'expected' => ['a' => 1, 'c' => 3],
			],
			'Pick all from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'pick' => ['a', 'b', 'c', 'd'],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
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
			Dash\pick($iterable, 'key');
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\pick expects iterable or stdClass or null but was given $type",
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
		$this->assertSame(['b' => 2, 'c' => 3], Dash\pick(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']));
	}
}
