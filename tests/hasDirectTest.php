<?php

/**
 * @covers Dash\hasDirect
 * @covers Dash\Curry\hasDirect
 */
class hasDirectTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $key, $expected)
	{
		$this->assertSame($expected, Dash\hasDirect($input, $key));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $key, $expected)
	{
		$hasDirect = Dash\Curry\hasDirect($key);
		$this->assertSame($expected, $hasDirect($input));
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
			'With an array key' => [
				'input' => ['foo' => 'value'],
				'key' => ['A', 'bar'],
				'expected' => false,
			],
			'With a closure key' => [
				'input' => ['foo' => 'value'],
				'key' => function () {
				},
				'expected' => false,
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

	public function testExamples()
	{
		$this->assertSame(true, Dash\hasDirect(['a' => 1, 'b' => 2], 'a'));
		$this->assertSame(false, Dash\hasDirect(['a' => 1, 'b' => 2], 'x'));
		$this->assertSame(true, Dash\hasDirect((object) ['a' => 1, 'b' => 2], 'a'));
		$this->assertSame(true, Dash\hasDirect(new DateTime(), 'getTimestamp'));
	}
}
