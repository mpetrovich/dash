<?php

/**
 * @covers Dash\reduce
 * @covers Dash\Curry\reduce
 */
class reduceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $iteratee, $initial, $expected)
	{
		$this->assertSame($expected, Dash\reduce($input, $iteratee, $initial));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $iteratee, $initial, $expected)
	{
		$reduce = Dash\Curry\reduce($iteratee, $initial);
		$this->assertSame($expected, $reduce($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With an empty array' => [
				'input' => [],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With an array' => [
				'input' => [1, 2, 3, 4],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With a non-empty stdClass' => [
				'input' => (object) [1, 2, 3, 4],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3, 4]),
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
		];
	}

	public function testIterateeArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
		$iterated = [];

		$iteratee = function ($result, $value, $key) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			return $result + $value;
		};

		$initial = 0;
		$result = Dash\reduce($iterable, $iteratee, $initial);

		$this->assertSame(10, $result);
		$this->assertSame($iterable, $iterated);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\reduce($iterable, function () {});
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\reduce expects iterable or stdClass or null but was given $type",
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
			10,
			Dash\reduce([1, 2, 3, 4], function ($sum, $value) {
				return $sum + $value;
			}, 0)
		);
	}
}
