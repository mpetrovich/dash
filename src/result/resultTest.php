<?php

/**
 * @covers Dash\result
 */
class resultTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $default, $expected)
	{
		$this->assertEquals($expected, Dash\result($input, $path, $default));
	}

	public function cases()
	{
		return [
			'With an array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a direct path' => [
				'input' => ['b' => function () { return 2; }],
				'path' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a nested path' => [
				'input' => [
					'a' => [
						'b' => [
							'c' => function () { return 'value'; }
						]
					]
				],
				'path' => 'a.b.c',
				'default' => 'default',
				'expected' => 'value',
			],
		];
	}
}
