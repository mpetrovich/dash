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
			'With an empty stdClass' => [
				'input' => (object) [],
				'predicate' => 'Dash\isOdd',
				'expected' => [],
			],
			'With a non-empty stdClass' => [
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
