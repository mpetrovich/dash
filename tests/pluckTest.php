<?php

/**
 * @covers Dash\pluck
 * @covers Dash\Curry\pluck
 */
class pluckTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $path, $expected)
	{
		$this->assertSame($expected, Dash\pluck($iterable, $path));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $path, $expected)
	{
		$pluck = Dash\Curry\pluck($path, null);
		$this->assertSame($expected, $pluck($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'path' => 'name',
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'path' => 'name',
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array with no matching paths' => [
				'iterable' => [
					false,
					[],
					'a',
				],
				'path' => 'name',
				'expected' => [null, null, null],
			],
			'With an indexed array with one matching path' => [
				'iterable' => [
					false,
					[],
					['name' => 'Pete', 'age' => 20],
				],
				'path' => 'name',
				'expected' => [null, null, 'Pete'],
			],
			'With an indexed array with some matching paths' => [
				'iterable' => [
					['name' => 'John'],
					['name' => 'Mary', 'age' => 35],
					['name' => 'Pete', 'age' => 20],
				],
				'path' => 'age',
				'expected' => [null, 35, 20],
			],

			/*
				With associative array
			 */

			'With an associative array with no matching paths' => [
				'iterable' => [
					'a' => false,
					'b' => [],
					'c' => 'a',
				],
				'path' => 'name',
				'expected' => [null, null, null],
			],
			'With an associative array with one matching path' => [
				'iterable' => [
					'a' => false,
					'b' => [],
					'c' => ['name' => 'Pete', 'age' => 20],
				],
				'path' => 'name',
				'expected' => [null, null, 'Pete'],
			],
			'With an associative array with some matching paths' => [
				'iterable' => [
					'a' => ['name' => 'John'],
					'b' => ['name' => 'Mary', 'age' => 35],
					'c' => ['name' => 'Pete', 'age' => 20],
				],
				'path' => 'age',
				'expected' => [null, 35, 20],
			],

			/*
				With stdClass
			 */

			'With an stdClass with no matching paths' => [
				'iterable' => (object) [
					'a' => false,
					'b' => [],
					'c' => 'a',
				],
				'path' => 'name',
				'expected' => [null, null, null],
			],
			'With an stdClass with one matching path' => [
				'iterable' => (object) [
					'a' => false,
					'b' => [],
					'c' => ['name' => 'Pete', 'age' => 20],
				],
				'path' => 'name',
				'expected' => [null, null, 'Pete'],
			],
			'With an stdClass with some matching paths' => [
				'iterable' => (object) [
					'a' => ['name' => 'John'],
					'b' => ['name' => 'Mary', 'age' => 35],
					'c' => ['name' => 'Pete', 'age' => 20],
				],
				'path' => 'age',
				'expected' => [null, 35, 20],
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject with no matching paths' => [
				'iterable' => new ArrayObject([
					'a' => false,
					'b' => [],
					'c' => 'a',
				]),
				'path' => 'name',
				'expected' => [null, null, null],
			],
			'With an ArrayObject with one matching path' => [
				'iterable' => new ArrayObject([
					'a' => false,
					'b' => [],
					'c' => ['name' => 'Pete', 'age' => 20],
				]),
				'path' => 'name',
				'expected' => [null, null, 'Pete'],
			],
			'With an ArrayObject with some matching paths' => [
				'iterable' => new ArrayObject([
					'a' => ['name' => 'John'],
					'b' => ['name' => 'Mary', 'age' => 35],
					'c' => ['name' => 'Pete', 'age' => 20],
				]),
				'path' => 'age',
				'expected' => [null, 35, 20],
			],
		];
	}

	public function testDefaultValue()
	{
		$iterable = [
			['name' => 'John'],
			['name' => 'Mary', 'age' => 35],
			['name' => 'Jane'],
			['name' => 'Pete', 'age' => 20],
		];

		$this->assertSame(
			['default', 35, 'default', 20],
			Dash\pluck($iterable, 'age', 'default')
		);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 */
	public function testTypeAssertions($iterable, $type)
	{
		$this->expectException(InvalidArgumentException::class);

		try {
			Dash\pluck($iterable, 'path');
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\pluck expects iterable or stdClass or null but was given $type",
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
		$data = [
			['name' => 'John'],
			['name' => 'Mary', 'age' => 35],
			['name' => 'Pete', 'age' => 20],
		];

		$this->assertSame(['John', 'Mary', 'Pete'], Dash\pluck($data, 'name'));
		$this->assertSame([null, 35, 20], Dash\pluck($data, 'age'));
	}
}
