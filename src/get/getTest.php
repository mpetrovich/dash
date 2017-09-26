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
	public function test($iterable, $path, $expected)
	{
		$this->assertSame($expected, Dash\get($iterable, $path, 'default'));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $path, $expected)
	{
		$get = Dash\_get($path, 'default');
		$this->assertSame($expected, $get($iterable));
	}

	public function cases()
	{
		return [
			'With a valid path for an object' => [
				(object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'a.b.c',
				'value'
			],
			'With an invalid path for an object' => [
				(object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'a.X.c',
				'default'
			],
			'With a valid array index' => [
				(object) [
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
				'a.1.b',
				'value'
			],
			'With an invalid array index' => [
				(object) [
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
				'a.2.b',
				'default'
			],
			'With a matching direct array key' => [
				['a.b.c' => 'value'],
				'a.b.c',
				'value'
			],
			'With a matching direct object property' => [
				(object) ['a.b.c' => 'value'],
				'a.b.c',
				'value'
			],
			'With a callable iteratee' => [
				(object) ['foo' => 'value'],
				function ($iterable) { return $iterable->foo; },
				'value'
			],
		];
	}
}
