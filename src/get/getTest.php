<?php

/**
 * @covers Dash\get
 */
class getTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $expected)
	{
		$actual = Dash\get($input, $path, 'default');
		$this->assertEquals($expected, $actual);
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
