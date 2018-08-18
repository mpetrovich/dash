<?php


class propertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForProperty
	 */
	public function testProperty($iterable, $path, $default, $expected)
	{
		$getter = Dash\property($path, $default);
		$this->assertSame($expected, $getter($iterable));
	}

	public function casesForProperty()
	{
		return [
			'With a null path' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => null,
				'default' => 'default',
				'expected' => 'default',
			],
			'With a direct array string index' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a direct array numeric index' => [
				'iterable' => ['a', 'b', 'c'],
				'path' => 1,
				'default' => 'default',
				'expected' => 'b',
			],
			'With a valid path for an object' => [
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
			'With an invalid path for an object' => [
				'iterable' => (object) [
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
				'iterable' => (object) [
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
				'iterable' => (object) [
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
				'iterable' => ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a matching direct object property' => [
				'iterable' => (object) ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a property with the same name as a global function' => [
				'iterable' => ['abs' => 'value'],
				'path' => 'abs',
				'default' => 'default',
				'expected' => 'value',
			],
			'With a nested property with the same name as a global function' => [
				'iterable' => ['a' => ['b' => ['abs' => 'value']]],
				'path' => 'a.b.abs',
				'default' => 'default',
				'expected' => 'value',
			],
		];
	}
}
