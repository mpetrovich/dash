<?php

/**
 * @covers Dash\get
 * @covers Dash\_get
 */
class getTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $path, $default, $expected)
	{
		$this->assertSame($expected, Dash\get($iterable, $path, $default));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $path, $default, $expected)
	{
		$get = Dash\_get($path, $default);
		$this->assertSame($expected, $get($iterable));
	}

	public function cases()
	{
		$func = function () { return 'result'; };

		return [
			'With null' => [
				'iterable' => null,
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'default',
			],
			'With matching null path' => [
				'iterable' => [null => 'value'],
				'path' => null,
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct array key' => [
				'iterable' => ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct object property' => [
				'iterable' => (object) [
					'a' => ['b' => ['c' => 'nested']],
					'a.b.c' => 'value',
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching null value' => [
				'iterable' => (object) [
					'a' => ['b' => ['c' => null]],
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => null,
			],
			'With a callable iteratee' => [
				'iterable' => (object) ['foo' => 'value'],
				'path' => function ($iterable) { return $iterable->foo; },
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable value' => [
				'iterable' => ['a' => ['b' => ['c' => $func]]],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => $func,
			],

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'default',
			],
			'With nested arrays and a matching path' => [
				'iterable' => [
					'a' => [
						['b' => ['c' => 'other']],
						['b' => ['c' => 'value']],
					]
				],
				'path' => 'a.1.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With nested arrays and a non-matching path' => [
				'iterable' => [
					'a' => [
						['b' => ['c' => 'other']],
						['b' => ['c' => 'value']],
					]
				],
				'path' => 'a.2.b.c',
				'default' => 'default',
				'expected' => 'default',
			],

			/*
				With stdClass
			 */

			'With with nested stdClass objects and a matching path' => [
				'iterable' => (object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With with nested stdClass objects and a non-matching path' => [
				'iterable' => (object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'path' => 'a.x.c',
				'default' => 'default',
				'expected' => 'default',
			],

			/*
				With ArrayObject
			 */

			'With with nested ArrayObjects and a matching path' => [
				'iterable' => new ArrayObject([
					'a' => new ArrayObject([
						'b' => new ArrayObject([
							'c' => 'value'
						])
					])
				]),
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With with nested ArrayObjects and a non-matching path' => [
				'iterable' => new ArrayObject([
					'a' => new ArrayObject([
						'b' => new ArrayObject([
							'c' => 'value'
						])
					])
				]),
				'path' => 'a.x.c',
				'default' => 'default',
				'expected' => 'default',
			],

			/*
				With mixed
			 */

			'With a mix of nested elements and a matching path' => [
				'iterable' => (object) [
					'a' => [
						new ArrayObject([
							'b' => (object) [
								'c' => 'other'
							]
						]),
						new ArrayObject([
							'b' => (object) [
								'c' => 'value'
							]
						]),
					]
				],
				'path' => 'a.1.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a mix of nested elements and a non-matching path' => [
				'iterable' => (object) [
					'a' => [
						new ArrayObject([
							'b' => (object) [
								'c' => 'other'
							]
						]),
						new ArrayObject([
							'b' => (object) [
								'c' => 'value'
							]
						]),
					]
				],
				'path' => 'a.2.b.c',
				'default' => 'default',
				'expected' => 'default',
			],
		];
	}

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($iterable, $path, $expected)
	{
		$this->assertSame($expected, Dash\get($iterable, $path));
	}

	public function casesDefault()
	{
		return [
			'With a matching path' => [
				'iterable' => ['a' => ['b' => ['c' => 'value']]],
				'path' => 'a.b.c',
				'expected' => 'value',
			],
			'With a non-matching path' => [
				'iterable' => ['a' => ['b' => ['c' => 'value']]],
				'path' => 'a.x.c',
				'expected' => null,
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
			Dash\get($iterable, 'foo');
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\get expects iterable or stdClass or null but was given $type",
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
		$iterable = [
			'people' => [
				['name' => 'Pete'],
				['name' => 'John'],
				['name' => 'Mark'],
			]
		];
		$this->assertSame('Mark', Dash\get($iterable, 'people.2.name'));

		$iterable = [
			'a.b.c' => 'direct',
			'a' => ['b' => ['c' => 'nested']]
		];
		$this->assertSame('direct', Dash\get($iterable, 'a.b.c'));
	}
}
