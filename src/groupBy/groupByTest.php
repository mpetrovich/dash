<?php

/**
 * @covers Dash\groupBy
 */
class groupByTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $groupBy, $expected)
	{
		$this->assertEquals($expected, Dash\groupBy($input, $groupBy));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3, 4, 5],
				'groupBy' => 'Dash\isOdd',
				'expected' => [true => [1, 3, 5], false => [2, 4]],
			],
			[
				'input' => [2.1, 2.5, 3.5, 3.9, 4],
				'groupBy' => 'floor',
				'expected' => [2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4]],
			],
			[
				'input' => [
					['name' => 'John', 'gender' => 'male'],
					['name' => 'Alice', 'gender' => 'female'],
					['name' => 'Jane', 'gender' => 'female'],
					['name' => 'Peter', 'gender' => 'male'],
					['name' => 'Fred', 'gender' => 'male'],
				],
				'groupBy' => 'gender',
				'expected' => [
					'male' => [
						['name' => 'John', 'gender' => 'male'],
						['name' => 'Peter', 'gender' => 'male'],
						['name' => 'Fred', 'gender' => 'male'],
					],
					'female' => [
						['name' => 'Alice', 'gender' => 'female'],
						['name' => 'Jane', 'gender' => 'female'],
					],
				],
			],
		];
	}
}
