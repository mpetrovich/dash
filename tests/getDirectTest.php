<?php

/**
 * @covers Dash\getDirect
 * @covers Dash\Curry\getDirect
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

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $key, $default, $expected)
	{
		$getDirect = Dash\Curry\getDirect($key, $default);
		$this->assertSame($expected, $getDirect($input));
	}

	public function cases()
	{
		$func = function () { return 'result'; };

		return [
			'With null' => [
				'input' => null,
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With matching null key' => [
				'input' => [null => 'value'],
				'key' => null,
				'default' => 'default',
				'expected' => 'value',
			],
			'With an array key' => [
				'input' => ['foo' => 'value'],
				'key' => ['A', 'bar'],
				'default' => 'default',
				'expected' => 'default',
			],
			'With a closure key' => [
				'input' => ['foo' => 'value'],
				'key' => function () {},
				'default' => 'default',
				'expected' => 'default',
			],
			'With matching null value' => [
				'input' => ['a' => null],
				'key' => 'a',
				'default' => 'default',
				'expected' => null,
			],
			'With a callable value' => [
				'input' => ['a' => $func],
				'key' => 'a',
				'default' => 'default',
				'expected' => $func,
			],

			/*
				With array
			 */

			'With an empty array' => [
				'input' => [],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct array key' => [
				'input' => ['a' => 'value'],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'input' => (object) [],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct stdClass property' => [
				'input' => (object) ['a' => 'value'],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct ArrayObject property' => [
				'input' => new ArrayObject(['a' => 'value']),
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],
		];
	}

	public function testCallable()
	{
		$callable = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
		$this->assertInternalType('callable', $callable);
		$this->assertSame(3, call_user_func($callable));
	}

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($input, $key, $expected)
	{
		$this->assertSame($expected, Dash\getDirect($input, $key));
	}

	public function casesDefault()
	{
		return [
			'With a matching key' => [
				'input' => ['a' => 'value'],
				'key' => 'a',
				'expected' => 'value',
			],
			'With a non-matching key' => [
				'input' => ['a' => 'value'],
				'key' => 'x',
				'expected' => null,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(
			Dash\getDirect(['a' => 'one', 'b' => 'two'], 'b'),
			'two'
		);
		$this->assertSame(
			Dash\getDirect((object) ['a' => 'one', 'b' => 'two'], 'b'),
			'two'
		);

		$count = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
		$this->assertSame($count(), 3);

		$input = new ArrayObject(['a' => 'array value']);
		$input->a = 'object value';
		$this->assertSame('array value', Dash\getDirect($input, 'a'));
	}
}
