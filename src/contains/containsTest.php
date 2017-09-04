<?php

/**
 * @covers Dash\contains
 */
class containsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $target, $comparator, $expected)
	{
		$this->assertSame($expected, Dash\contains($input, $target, $comparator));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'input' => [],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an array' => [
				'input' => [1, 2, 3],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With an array' => [
				'input' => [1, 2, 3],
				'target' => 4,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'target' => 'c',
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject(),
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'target' => 5,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With a loose comparator' => [
				'input' => [1, '2', 3],
				'target' => 2,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With a strict comparator' => [
				'input' => [1, '2', 3],
				'target' => 2,
				'comparator' => 'Dash\identical',
				'expected' => false,
			],
		];
	}
}
