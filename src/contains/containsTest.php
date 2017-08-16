<?php

/**
 * @covers Dash\contains
 */
class containsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $target, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\contains($input, $target, $predicate));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty array' => [
				'input' => [],
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With a non-empty array' => [
				'input' => [1, 2, 3],
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => true,
			],
			'With a non-empty array' => [
				'input' => [1, 2, 3],
				'target' => 4,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => true,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'target' => 'c',
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject(),
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => true,
			],
			'With a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'target' => 5,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
		];
	}
}
