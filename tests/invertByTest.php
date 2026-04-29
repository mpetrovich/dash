<?php

/**
 * @covers Dash\invertBy
 * @covers Dash\Curry\invertBy
 */
class invertByTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$input = ['a' => 'x', 'b' => 'y', 'c' => 'x'];
		$this->assertSame(['x' => ['a', 'c'], 'y' => ['b']], Dash\invertBy($input));
	}

	public function testCurried()
	{
		$f = Dash\Curry\invertBy('Dash\identity');
		$this->assertSame(['x' => ['a', 'c'], 'y' => ['b']], $f(['a' => 'x', 'b' => 'y', 'c' => 'x']));
	}

	public function testWithIteratee()
	{
		$input = [
			'a' => ['type' => 'x'],
			'b' => ['type' => 'y'],
			'c' => ['type' => 'x'],
		];

		$this->assertSame(['x' => ['a', 'c'], 'y' => ['b']], Dash\invertBy($input, 'type'));
	}
}
