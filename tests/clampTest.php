<?php

/**
 * @covers Dash\clamp
 * @covers Dash\Curry\clamp
 */
class clampTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(3, Dash\clamp(3, 1, 5));
		$this->assertSame(1, Dash\clamp(-2, 1, 5));
		$this->assertSame(5, Dash\clamp(10, 1, 5));
	}

	public function testCurried()
	{
		$f = Dash\Curry\clamp(1, 5);
		$this->assertSame(3, $f(3));
		$this->assertSame(1, $f(-2));
		$this->assertSame(5, $f(10));
	}
}
