<?php

/**
 * @covers Dash\hasDirect
 */
class hasDirectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $key, $expected)
	{
		$this->assertSame($expected, Dash\hasDirect($input, $key));
	}

	public function cases()
	{
		return [
			'With non-matching null key' => [
				'input' => [1, 2, 3],
				'key' => null,
				'expected' => false,
			],
			'With matching null key' => [
				'input' => [null => 'foo'],
				'key' => null,
				'expected' => true,
			],
			'With null' => [
				'input' => null,
				'key' => 'foo',
				'expected' => false,
			],
			'With a number' => [
				'input' => 123.45,
				'key' => 'foo',
				'expected' => false,
			],
			'With a string' => [
				'input' => 'hello',
				'key' => 'foo',
				'expected' => false,
			],
			'With a callable method' => [
				'input' => new DateTime(),
				'key' => 'getTimestamp',
				'expected' => true,
			],
			'With an empty array' => [
				'input' => [],
				'key' => 0,
				'expected' => false,
			],
			'With an indexed array' => [
				'input' => [2, 3, 5, 8],
				'key' => 2,
				'expected' => true,
			],
			'With an associative array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'expected' => true,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'key' => 'b',
				'expected' => false,
			],
			'With an stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'expected' => true,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'key' => 'b',
				'expected' => false,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'key' => 'b',
				'expected' => true,
			],
		];
	}
}
