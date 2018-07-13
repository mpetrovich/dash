<?php

/**
 * @covers Dash\each
 * @covers Dash\_each
 */
class eachTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$self = $this;
		$iterated = [];
		$iteratee = function ($value, $key, $iterable2) use ($self, $iterable, &$iterated) {
			$self->assertSame($iterable, $iterable2);
			$iterated[] = $key . ' is ' . $value;
		};

		$returned = Dash\each($iterable, $iteratee);

		$this->assertSame($expected, $iterated);
		$this->assertSame($iterable, $returned);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$self = $this;
		$iterated = [];
		$iteratee = function ($value, $key, $iterable2) use ($self, $iterable, &$iterated) {
			$self->assertSame($iterable, $iterable2);
			$iterated[] = $key . ' is ' . $value;
		};

		$each = Dash\_each($iteratee);
		$returned = $each($iterable);

		$this->assertSame($expected, $iterated);
		$this->assertSame($iterable, $returned);
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
			'With an indexed array' => [
				'iterable' => [
					'first',
					'second',
					'third',
				],
				'expected' => [
					'0 is first',
					'1 is second',
					'2 is third',
				],
			],
			'With an associative array' => [
				'iterable' => [
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				],
				'expected' => [
					'a is first',
					'b is second',
					'c is third',
				],
			],
			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => [],
			],
			'With an stdClass' => [
				'iterable' => (object) [
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				],
				'expected' => [
					'a is first',
					'b is second',
					'c is third',
				],
			],
			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => [],
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject([
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				]),
				'expected' => [
					'a is first',
					'b is second',
					'c is third',
				],
			],
		];
	}

	public function testIterateeArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iterated = [];

		$iteratee = function ($value, $key, $passedIterable) use (&$iterated, $iterable) {
			$iterated[$key] = $value;
			$this->assertSame($iterable, $passedIterable);
		};

		$returned = Dash\each($iterable, $iteratee);

		$this->assertSame($iterable, $iterated);
		$this->assertSame($iterable, $returned);
	}

	public function testEarlyExit()
	{
		$iterated = [];

		Dash\each(['a', 'b', 'c', 'd'], function ($value) use (&$iterated) {
			$iterated[] = $value;
			if ($value === 'b') {
				return false;
			}
		});

		$this->assertSame(['a', 'b'], $iterated);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\each($iterable, function () {});
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\each expects iterable or stdClass or null but was given $type",
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
}
