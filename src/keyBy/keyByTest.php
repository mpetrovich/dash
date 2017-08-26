<?php

/**
 * @covers Dash\keyBy
 */
class keyByTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $keyBy, $expected)
	{
		$this->assertEquals($expected, Dash\keyBy($input, $keyBy));
		$this->assertEquals($expected, Dash\indexBy($input, $keyBy));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3, 4, 5],
				'keyBy' => 'Dash\identity',
				'expected' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
			],
			[
				'input' => [
					['name' => 'John', 'gender' => 'male'],
					['name' => 'Alice', 'gender' => 'female'],
					['name' => 'Jane', 'gender' => 'female'],
					['name' => 'Peter', 'gender' => 'male'],
					['name' => 'Fred', 'gender' => 'male'],
				],
				'keyBy' => 'name',
				'expected' => [
					'John' => ['name' => 'John', 'gender' => 'male'],
					'Alice' => ['name' => 'Alice', 'gender' => 'female'],
					'Jane' => ['name' => 'Jane', 'gender' => 'female'],
					'Peter' => ['name' => 'Peter', 'gender' => 'male'],
					'Fred' => ['name' => 'Fred', 'gender' => 'male'],
				],
			],
		];
	}
}
