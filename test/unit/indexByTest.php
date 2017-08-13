<?php

class indexByTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $indexBy, $expected)
	{
		$this->assertEquals($expected, Dash\indexBy($input, $indexBy));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3, 4, 5],
				'indexBy' => 'Dash\identity',
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
				'indexBy' => 'name',
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

