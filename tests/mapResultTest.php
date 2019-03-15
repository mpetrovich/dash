<?php

/**
 * @covers Dash\mapResult
 * @covers Dash\Curry\mapResult
 */
class mapResultTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $path, $default, $expected)
	{
		$this->assertSame($expected, Dash\mapResult($iterable, $path, $default));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $path, $default, $expected)
	{
		$mapResult = Dash\Curry\mapResult($path, $default);
		$this->assertEquals($expected, $mapResult($iterable));
	}

	public function cases()
	{
		return [

			/*
				With empty/non-iterables
			 */

			'With null' => [
				'iterable' => null,
				'path' => 'fn',
				'default' => 'default',
				'expected' => [],
			],
			'With an empty array' => [
				'iterable' => [],
				'path' => 'fn',
				'default' => 'default',
				'expected' => [],
			],
			'With an empty stdClass' => [
				'iterable' => (object) [],
				'path' => 'fn',
				'default' => 'default',
				'expected' => [],
			],
			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject(),
				'path' => 'fn',
				'default' => 'default',
				'expected' => [],
			],

			/*
				With indexed array
			 */

			'With an indexed array and a direct property path' => [
				'iterable' => [
					['fn' => function() { return 'a fn'; }],
					['fn' => function() { return 'b fn'; }],
					[],
					['fn' => function() { return 'd fn'; }],
					null,
				],
				'path' => 'fn',
				'default' => 'default',
				'expected' => [
					'a fn',
					'b fn',
					'default',
					'd fn',
					'default',
				],
			],
			'With an indexed array and a nested property path' => [
				'iterable' => [
					[
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'a fn'; }]
						],
					],
					[
						'foo' => [
							'bar',
							[]
						],
					],
					[
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'c fn'; }]
						],
					],
					[
						'foo' => [
							'bar',
							null
						],
					],
					[
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'e fn'; }]
						],
					],
					null,
				],
				'path' => 'foo.1.fn',
				'default' => 'default',
				'expected' => [
					'a fn',
					'default',
					'c fn',
					'default',
					'e fn',
					'default',
				],
			],

			/*
				With associative array
			 */

			'With an associative array and a direct property path' => [
				'iterable' => [
					'a' => ['fn' => function() { return 'a fn'; }],
					'b' => ['fn' => function() { return 'b fn'; }],
					'c' => [],
					'd' => ['fn' => function() { return 'd fn'; }],
					'e' => null,
				],
				'path' => 'fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'b fn',
					'c' => 'default',
					'd' => 'd fn',
					'e' => 'default',
				],
			],
			'With an associative array and a nested property path' => [
				'iterable' => [
					'a' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'a fn'; }]
						],
					],
					'b' => [
						'foo' => [
							'bar',
							[]
						],
					],
					'c' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'c fn'; }]
						],
					],
					'd' => [
						'foo' => [
							'bar',
							null
						],
					],
					'e' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'e fn'; }]
						],
					],
					'f' => null,
				],
				'path' => 'foo.1.fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'default',
					'c' => 'c fn',
					'd' => 'default',
					'e' => 'e fn',
					'f' => 'default',
				],
			],

			/*
				With stdClass
			 */

			'With an stdClass and a direct property path' => [
				'iterable' => (object) [
					'a' => ['fn' => function() { return 'a fn'; }],
					'b' => ['fn' => function() { return 'b fn'; }],
					'c' => [],
					'd' => ['fn' => function() { return 'd fn'; }],
					'e' => null,
				],
				'path' => 'fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'b fn',
					'c' => 'default',
					'd' => 'd fn',
					'e' => 'default',
				],
			],
			'With an stdClass and a nested property path' => [
				'iterable' => (object) [
					'a' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'a fn'; }]
						],
					],
					'b' => [
						'foo' => [
							'bar',
							[]
						],
					],
					'c' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'c fn'; }]
						],
					],
					'd' => [
						'foo' => [
							'bar',
							null
						],
					],
					'e' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'e fn'; }]
						],
					],
					'f' => null,
				],
				'path' => 'foo.1.fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'default',
					'c' => 'c fn',
					'd' => 'default',
					'e' => 'e fn',
					'f' => 'default',
				],
			],

			/*
				With ArrayObject
			 */

			'With an ArrayObject and a direct property path' => [
				'iterable' => new ArrayObject([
					'a' => ['fn' => function() { return 'a fn'; }],
					'b' => ['fn' => function() { return 'b fn'; }],
					'c' => [],
					'd' => ['fn' => function() { return 'd fn'; }],
					'e' => null,
				]),
				'path' => 'fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'b fn',
					'c' => 'default',
					'd' => 'd fn',
					'e' => 'default',
				],
			],
			'With an ArrayObject and a nested property path' => [
				'iterable' => new ArrayObject([
					'a' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'a fn'; }]
						],
					],
					'b' => [
						'foo' => [
							'bar',
							[]
						],
					],
					'c' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'c fn'; }]
						],
					],
					'd' => [
						'foo' => [
							'bar',
							null
						],
					],
					'e' => [
						'foo' => [
							'bar',
							(object) ['fn' => function() { return 'e fn'; }]
						],
					],
					'f' => null,
				]),
				'path' => 'foo.1.fn',
				'default' => 'default',
				'expected' => [
					'a' => 'a fn',
					'b' => 'default',
					'c' => 'c fn',
					'd' => 'default',
					'e' => 'e fn',
					'f' => 'default',
				],
			],
		];
	}

	/**
	 * Verifies that when the path has the same name as a global function,
	 * the global function is never used.
	 */
	public function testNoGlobalFunctionInvocation()
	{
		$iterable = [
			'a' => ['abs' => 'one'],
			'b' => [],
			'c' => ['abs' => 'three'],
		];
		$path = 'abs';
		$default = 'default';
		$actual = Dash\mapResult($iterable, $path, $default);

		$expected = ['a' => 'one', 'b' => 'default', 'c' => 'three'];

		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			$path = 'fn';
			Dash\mapResult($iterable, $path);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\mapResult expects iterable or stdClass or null but was given $type",
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
			'john' => ['getHash' => function() { return md5('John Doe'); }],
			'jane' => ['getHash' => function() { return md5('Jane Doe'); }],
			'paul' => ['getHash' => function() { return md5('Paul Dyk'); }],
		];

		$this->assertSame(
			[
				'john' => '4c2a904bafba06591225113ad17b5cec',
				'jane' => '1c272047233576d77a9b9a1acfdf741c',
				'paul' => '022fbf2743848afb47158d9c80f28d03',
			],
			Dash\mapResult($data, 'getHash')
		);
	}
}
