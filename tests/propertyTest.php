<?php

/**
 * @covers Dash\property
 * @covers Dash\Curry\property
 */
class propertyTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $default, $expected)
	{
		$getter = Dash\property($path, $default);
		$this->assertSame($expected, $getter($input));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $path, $default, $expected)
	{
		$property = Dash\Curry\property($default);
		$getter = $property($path);
		$this->assertSame($expected, $getter($input));
	}

	public function cases()
	{
		return [
			'With a null path' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => null,
				'default' => 'default',
				'expected' => 'default',
			],
			'With a direct array string index' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a direct array numeric index' => [
				'input' => ['a', 'b', 'c'],
				'path' => 1,
				'default' => 'default',
				'expected' => 'b',
			],
			'With a valid path for an object' => [
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
			'With an invalid path for an object' => [
				'input' => (object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'path' => 'a.X.c',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a valid array index' => [
				'input' => (object) [
					'a' => [
						(object) [
							'x' => (object) [
								'y' => 'other'
							]
						],
						(object) [
							'b' => 'value'
						],
					]
				],
				'path' => 'a.1.b',
				'default' => 'default',
				'expected' => 'value',
			],
			'With an invalid array index' => [
				'input' => (object) [
					'a' => [
						(object) [
							'x' => (object) [
								'y' => 'other'
							]
						],
						(object) [
							'b' => 'value'
						],
					]
				],
				'path' => 'a.2.b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct array key' => [
				'input' => ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct object property' => [
				'input' => (object) ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a property with the same name as a global function' => [
				'input' => ['abs' => 'value'],
				'path' => 'abs',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a nested property with the same name as a global function' => [
				'input' => ['a' => ['b' => ['abs' => 'value']]],
				'path' => 'a.b.abs',
				'default' => 'default',
				'expected' => 'value',
			],
		];
	}

	/**
	 * @dataProvider casesClassInstance
	 */
	public function testClassInstance($path, $default, $input, $expected)
	{
		$getter = Dash\property($path, $default);
		$countFn = $getter($input);
		$this->assertSame($expected, $countFn());
	}

	public function casesClassInstance()
	{
		return [
			'With class instance' => [
				'path' => 'count',
				'default' => 'default',
				'input' => new ArrayObject([1, 2, 3]),
				'expected' => 3,
			],
			'With nested class instance' => [
				'path' => 'items.count',
				'default' => 'default',
				'input' => ['items' => new ArrayObject([1, 2, 3])],
				'expected' => 3,
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 */
	public function testTypeAssertions($path, $type)
	{
		$this->expectException(InvalidArgumentException::class);

		try {
			Dash\property($path);
		} catch (Exception $e) {
			$this->assertSame(
				"Dash\\property expects string or numeric or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With an array' => [
				'path' => [1, 2, 3],
				'type' => 'array',
			],
			'With an stdClass' => [
				'path' => (object) [1, 2, 3],
				'type' => 'stdClass',
			],
			'With a DateTime' => [
				'path' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}

	public function testExamples()
	{
		$getter = Dash\property('foo');
		$this->assertSame('value', $getter(['foo' => 'value']));
		$this->assertSame('value', $getter((object) ['foo' => 'value']));

		$getter = Dash\property('items.count');
		$countFn = $getter(['items' => new ArrayObject([1, 2, 3])]);
		$this->assertSame(3, $countFn());

		$getter = Dash\property('a.b.c');
		$this->assertSame('value', $getter([
			'a' => [
				'b' => [
					'c' => 'value'
				]
			]
		]));

		$getter = Dash\property('items.1.name');
		$this->assertSame('two', $getter([
			'items' => [
				['name' => 'one'],
				['name' => 'two'],
				['name' => 'three'],
			]
		]));

		$getter = Dash\property('a.b.c');
		$this->assertSame('value', $getter(['a.b.c' => 'value']));
	}
}
