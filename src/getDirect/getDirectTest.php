<?php

/**
 * @covers Dash\getDirect
 */
class getDirectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $key, $default, $expected)
	{
		$this->assertSame($expected, Dash\getDirect($input, $key, $default));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'key' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a string' => [
				'input' => 'hello',
				'key' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an empty array' => [
				'input' => [],
				'key' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'key' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'key' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'key' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
		];
	}

	public function testCallable()
	{
		$callable = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
		$this->assertInternalType('callable', $callable);
		$this->assertSame(3, call_user_func($callable));
	}
}
