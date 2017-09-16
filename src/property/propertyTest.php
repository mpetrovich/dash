<?php


class propertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForProperty
	 */
	public function testProperty($iterable, $path, $expected)
	{
		$getter = Dash\property($path, 'default');
		$this->assertSame($expected, $getter($iterable));
	}

	public function casesForProperty()
	{
		return [
			'With a direct array index' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'expected' => 2,
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
				'expected' => 'default',
			],
			'With a matching direct array key' => [
				'iterable' => ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'expected' => 'value',
			],
			'With a matching direct object property' => [
				'iterable' => (object) ['a.b.c' => 'value'],
				'path' => 'a.b.c',
				'expected' => 'value',
			],
			'With a getter function as a path' => [
				'iterable' => ['a.b.c' => 'value'],
				'path' => function ($iterable) { return $iterable['a.b.c']; },
				'expected' => 'value',
			],
		];
	}
}
