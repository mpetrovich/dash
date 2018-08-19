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
	public function test($input, $path, $default, $expected)
	{
		$this->assertSame($expected, Dash\get($input, $path, $default));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $path, $default, $expected)
	{
		$get = Dash\_get($path, $default);
		$this->assertSame($expected, $get($input));
	}

	public function cases()
	{
		$func = function () { return 'result'; };

		return [
			'With null' => [
				'input' => null,
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'default',
			],
			'With matching null path' => [
				'input' => [null => 'value'],
				'path' => null,
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct array key' => [
				'input' => ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct numeric key' => [
				'input' => [3 => 'value'],
				'path' => 3,
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct object property' => [
				'input' => (object) [
					'a' => ['b' => ['c' => 'nested']],
					'a.b.c' => 'value',
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching null value' => [
				'input' => (object) [
					'a' => ['b' => ['c' => null]],
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => null,
			],
			'With a callable iteratee as an anonymous closure' => [
				'input' => ['foo' => 'value'],
				'path' => function ($input) { return $input['foo']; },
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable iteratee as a static method string' => [
				'input' => ['foo' => 'value'],
				'path' => 'getTest::staticMethod',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable iteratee as a static method array' => [
				'input' => ['foo' => 'value'],
				'path' => ['getTest', 'staticMethod'],
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable iteratee as an instance method' => [
				'input' => ['foo' => 'value'],
				'path' => [$this, 'instanceMethod'],
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable value' => [
				'input' => ['a' => ['b' => ['c' => $func]]],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => $func,
			],
			'With a path with the same name as a global function' => [
				'input' => ['abs' => 'value'],
				'path' => 'abs',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a nested path with the same name as a global function' => [
				'input' => ['a' => ['b' => ['abs' => 'value']]],
				'path' => 'a.b.abs',
				'default' => 'default',
				'expected' => 'value',
			],

			/*
				With array
			 */

			'With an empty array' => [
				'input' => [],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'default',
			],
			'With nested arrays and a matching path' => [
				'input' => [
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
				'input' => [
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
				'input' => (object) [
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
				'input' => (object) [
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
				'input' => new ArrayObject([
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
				'input' => new ArrayObject([
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
				'input' => (object) [
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
				'input' => (object) [
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

	public static function staticMethod($input)
	{
		return $input['foo'];
	}

	public function instanceMethod($input)
	{
		return $input['foo'];
	}

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($input, $path, $expected)
	{
		$this->assertSame($expected, Dash\get($input, $path));
	}

	public function casesDefault()
	{
		return [
			'With a matching path' => [
				'input' => ['a' => ['b' => ['c' => 'value']]],
				'path' => 'a.b.c',
				'expected' => 'value',
			],
			'With a non-matching path' => [
				'input' => ['a' => ['b' => ['c' => 'value']]],
				'path' => 'a.x.c',
				'expected' => null,
			],
		];
	}

	public function testExamples()
	{
		$input = [
			'people' => [
				['name' => 'Pete'],
				['name' => 'John'],
				['name' => 'Mark'],
			]
		];
		$this->assertSame('Mark', Dash\get($input, 'people.2.name'));

		$input = [
			'a.b.c' => 'direct',
			'a' => ['b' => ['c' => 'nested']]
		];
		$this->assertSame('direct', Dash\get($input, 'a.b.c'));
	}
}
