<?php

/**
 * @covers Dash\where
 */
class whereTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $properties, $expected)
	{
		$actual = Dash\where($iterable, $properties);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'iterable' => [],
				'properties' => ['age' => 30],
				'expected' => [],
			],
			'With an empty object' => [
				'iterable' => (object) [],
				'properties' => ['age' => 30],
				'expected' => [],
			],
			'With an indexed array' => [
				'iterable' => [
					['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
					['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
					['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
					['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
				'properties' => ['gender' => 'f', 'age' => 30],
				'expected' => [
					['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
			],
			'With an associative array' => [
				'iterable' => [
					'a' => ['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
					'b' => ['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
					'c' => ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					'd' => ['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
					'e' => ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
				'properties' => ['gender' => 'f', 'age' => 30],
				'expected' => [
					'c' => ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					'e' => ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
			],
			'With an object' => [
				'iterable' => [
					'a' => (object) ['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
					'b' => (object) ['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
					'c' => (object) ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					'd' => (object) ['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
					'e' => (object) ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
				'properties' => ['gender' => 'f', 'age' => 30],
				'expected' => [
					'c' => (object) ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					'e' => (object) ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				],
			],
		];
	}
}
