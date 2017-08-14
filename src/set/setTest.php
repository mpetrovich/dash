<?php

class setTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $value, $expected)
	{
		$output = Dash\set($input, $path, $value);

		$this->assertEquals($expected, $input);
		$this->assertSame($input, $output);

		$parentPath = implode('.', array_slice(explode('.', $path), 0, -1));
		$this->assertSame(Dash\get($input, $parentPath), Dash\get($output, $parentPath));
	}

	public function cases()
	{
		return [

			/*
				Top-level field access
			 */

			[
				'input' => [1, 2, 3],
				'path' => '2',
				'value' => 4,
				'expected' => [1, 2, 4],
			],
			[
				'input' => (object) [1, 2, 3],
				'path' => '2',
				'value' => 4,
				'expected' => (object) [1, 2, 4],
			],
			[
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'value' => 4,
				'expected' => ['a' => 1, 'b' => 4, 'c' => 3],
			],
			[
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'path' => 'b',
				'value' => 4,
				'expected' => (object) ['a' => 1, 'b' => 4, 'c' => 3],
			],

			/*
				Nested field access
			 */

			[
				'input' => [
					'a' => [
						(object) [
							'b' => 123
						],
						(object) [
							'c' => 456
						],
					],
				],
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => [
					'a' => [
						(object) [
							'b' => 123
						],
						(object) [
							'c' => 789
						],
					],
				],
			],
			[
				'input' => (object) [
					'a' => [
						'b' => [123, 456],
					],
				],
				'path' => 'a.b.1',
				'value' => 789,
				'expected' => (object) [
					'a' => [
						'b' => [123, 789],
					],
				],
			],

			/*
				With intermediate field creation
			 */

			'Null input' => [
				'input' => null,
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => [
					'a' => [
						1 => [
							'c' => 789
						],
					],
				],
			],
			'Empty array input' => [
				'input' => [],
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => [
					'a' => [
						1 => [
							'c' => 789
						],
					],
				],
			],
			'Empty object input' => [
				'input' => (object) [],
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => (object) [
					'a' => (object) [
						1 => (object) [
							'c' => 789
						],
					],
				],
			],
			'Non-empty array/object input' => [
				'input' => [
					'a' => (object) [
						2 => [],
					],
				],
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => (object) [
					'a' => (object) [
						1 => [
							'c' => 789
						],
						2 => [],
					],
				],
			],
			'Non-empty array/object input' => [
				'input' => (object) [
					'a' => [
						2 => (object) [],
					],
				],
				'path' => 'a.1.c',
				'value' => 789,
				'expected' => (object) [
					'a' => [
						1 => [
							'c' => 789
						],
						2 => (object) [],
					],
				],
			],
		];
	}
}

