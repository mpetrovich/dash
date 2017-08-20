<?php

/**
 * @covers Dash\filter
 */
class filterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\filter($input, $predicate));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an empty array' => [
				'input' => [],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an array' => [
				'input' => [1, 2, 3],
				'predicate' => 'Dash\isOdd',
				'expected' => [0 => 1, 2 => 3],
			],
			'With matchesProperty() shorthand with an array' => [
				'input' => [
					'a' => ['name' => 'John', 'age' => 30, 'gender' => 'male', 'active' => false],
					'b' => ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'c' => ['name' => 'Kane', 'age' => 33, 'gender' => 'male', 'active' => false],
					'd' => ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
				'predicate' => 'active',
				'expected' => [
					'b' => ['name' => 'Jane', 'age' => 27, 'gender' => 'female', 'active' => true],
					'd' => ['name' => 'Pete', 'age' => 35, 'gender' => 'male', 'active' => true],
				],
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 1, 'c' => 3],
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'predicate' => 'Dash\isOdd',
				'expected' => ['a' => 1, 'c' => 3],
			],
		];
	}

	public function testPredicate()
	{
		$input = ['a' => 2];

		$predicate = function ($value, $key, $iterable) use ($input) {
			$this->assertSame(2, $value);
			$this->assertSame('a', $key);
			$this->assertSame($input, $iterable);
		};

		Dash\filter($input, $predicate);
	}
}
