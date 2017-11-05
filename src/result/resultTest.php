<?php

/**
 * @covers Dash\result
 * @covers Dash\_result
 */
class resultTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $default, $expected)
	{
		$this->assertSame($expected, Dash\result($input, $path, $default));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $path, $default, $expected)
	{
		$result = Dash\_result($path, $default);
		$this->assertSame($expected, $result($input));
	}

	public function cases()
	{
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
			'With a callable iteratee' => [
				'input' => (object) ['foo' => 'value'],
				'path' => function ($input) { return $input->foo; },
				'default' => 'default',
				'expected' => 'value',
			],
			'With a callable value' => [
				'input' => ['a' => ['b' => ['c' => function () { return 'result'; }]]],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'result',
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
			'With with an ArrayObject and a callable path' => [
				'input' => new ArrayObject([
					'a' => 1,
					'b' => 2,
					'c' => 3,
				]),
				'path' => 'count',
				'default' => 'default',
				'expected' => 3,
			],
			'With with an ArrayObject and a callable nested path' => [
				'input' => new ArrayObject([
					'items' => new ArrayObject([
						'a' => 1,
						'b' => 2,
						'c' => 3,
					])
				]),
				'path' => 'items.count',
				'default' => 'default',
				'expected' => 3,
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

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($input, $path, $expected)
	{
		$this->assertSame($expected, Dash\result($input, $path));
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
			'people' => new ArrayObject([
				['name' => 'Pete', 'joined' => new DateTime('2017-01-01')],
				['name' => 'John', 'joined' => new DateTime('2017-02-02')],
				['name' => 'Paul', 'joined' => new DateTime('2017-04-04')],
			])
		];

		$this->assertSame(
			Dash\result($input, 'people.1.name'),
			'John'
		);

		$this->assertSame(
			Dash\result($input, 'people.count'),
			3
		);

		$this->assertSame(
			Dash\result($input, 'people.1.joined.getTimestamp'),
			1485993600
		);
	}
}
