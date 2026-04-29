<?php

/**
 * @covers Dash\has
 * @covers Dash\Curry\has
 */
class hasTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $path, $expected)
	{
		$this->assertSame($expected, Dash\has($input, $path));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $path, $expected)
	{
		$has = Dash\Curry\has($path);
		$this->assertSame($expected, $has($input));
	}

	public function cases()
	{
		return [
			'With null input' => [null, 'a.b', false],
			'With direct key' => [['a' => 1], 'a', true],
			'With nested path' => [['a' => ['b' => ['c' => 1]]], 'a.b.c', true],
			'With missing nested path' => [['a' => ['b' => ['c' => 1]]], 'a.b.x', false],
			'With direct dotted key precedence' => [['a.b' => 1, 'a' => ['b' => 2]], 'a.b', true],
			'With null value present' => [['a' => ['b' => null]], 'a.b', true],
			'With stdClass path' => [(object) ['a' => (object) ['b' => 2]], 'a.b', true],
			'With callable path' => [['a' => 1], function ($input) { return $input['a']; }, true],
		];
	}
}
