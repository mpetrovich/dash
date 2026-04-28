<?php

/**
 * @covers Dash\omit
 * @covers Dash\Curry\omit
 * @covers Dash\Generator\filter
 */
class omitTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $keys, $expected)
	{
		$this->assertEquals($expected, Dash\omit($iterable, $keys));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $keys, $expected)
	{
		$omit = Dash\Curry\omit($keys);
		$this->assertEquals($expected, $omit($iterable));
	}

	public function cases()
	{
		return [
			'Omit null from an empty array' => [
				'iterable' => [],
				'omit' => null,
				'expected' => [],
			],
			'Omit none from an empty array' => [
				'iterable' => [],
				'omit' => [],
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'Omit none from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'omit' => [],
				'expected' => [1, 2, 3, 4],
			],
			'Omit one from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'omit' => 2,
				'expected' => [1, 2, 4],
			],
			'Omit several from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'omit' => [0, 2],
				'expected' => [2, 4],
			],
			'Omit all from an indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'omit' => [0, 1, 2, 3],
				'expected' => [],
			],

			/*
				With associative array
			 */

			'Omit none from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => [],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
			],
			'Omit one from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => 'b',
				'expected' => ['a' => 1, 'c' => 3, 'd' => 4],
			],
			'Omit several from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => ['a', 'c'],
				'expected' => ['b' => 2, 'd' => 4],
			],
			'Omit all from an associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => ['a', 'b', 'c', 'd'],
				'expected' => [],
			],

			/*
				With stdClass
			 */

			'Omit none from an empty stdClass' => [
				'iterable' => (object) [],
				'omit' => [],
				'expected' => [],
			],
			'Omit one from an empty stdClass' => [
				'iterable' => (object) [],
				'omit' => 'b',
				'expected' => [],
			],
			'Omit several from an empty stdClass' => [
				'iterable' => (object) [],
				'omit' => ['a', 'c'],
				'expected' => [],
			],
			'Omit none from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => [],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
			],
			'Omit one from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => 'b',
				'expected' => ['a' => 1, 'c' => 3, 'd' => 4],
			],
			'Omit several from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => ['a', 'c'],
				'expected' => ['b' => 2, 'd' => 4],
			],
			'Omit all from an stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'omit' => ['a', 'b', 'c', 'd'],
				'expected' => [],
			],

			/*
				With ArrayObject
			 */

			'Omit none from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'omit' => [],
				'expected' => [],
			],
			'Omit one from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'omit' => 'b',
				'expected' => [],
			],
			'Omit several from an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'omit' => ['a', 'c'],
				'expected' => [],
			],
			'Omit none from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'omit' => [],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
			],
			'Omit one from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'omit' => 'b',
				'expected' => ['a' => 1, 'c' => 3, 'd' => 4],
			],
			'Omit several from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'omit' => ['a', 'c'],
				'expected' => ['b' => 2, 'd' => 4],
			],
			'Omit all from an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'omit' => ['a', 'b', 'c', 'd'],
				'expected' => [],
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 */
	public function testTypeAssertions($iterable, $type)
	{
		$this->expectException(InvalidArgumentException::class);

		try {
			Dash\omit($iterable, 'key');
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\omit expects iterable or stdClass or null but was given $type",
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
		$this->assertSame(['a' => 1, 'd' => 4], Dash\omit(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['b', 'c']));
	}

	/**
	 * @dataProvider casesGenerator
	 */
	public function testGenerator($iterable, $keys, $expected)
	{
		$result = Dash\omit($iterable, $keys);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals($expected, iterator_to_array($result));
	}

	public function casesGenerator()
	{
		$generator = function ($iterable) {
			foreach ((array) $iterable as $key => $value) {
				yield $key => $value;
			}
		};

		return [
			'Omit one from indexed array' => [
				'iterable' => $generator([1, 2, 3, 4]),
				'omit' => 2,
				'expected' => [1, 2, 4],
			],
			'Omit several from associative array' => [
				'iterable' => $generator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'omit' => ['a', 'c'],
				'expected' => ['b' => 2, 'd' => 4],
			],
		];
	}

	public function testGeneratorIsLazy()
	{
		$iterations = 0;
		$generator = function () use (&$iterations) {
			$iterations++;
			yield 'a' => 1;
			$iterations++;
			yield 'b' => 2;
		};

		$result = Dash\omit($generator(), ['a']);
		$this->assertSame(0, $iterations);
		$this->assertSame(['b' => 2], iterator_to_array($result));
		$this->assertSame(2, $iterations);
	}
}
