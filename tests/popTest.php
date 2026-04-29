<?php

/**
 * @covers Dash\pop
 * @covers Dash\Curry\pop
 */
class popTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(3, Dash\pop([1, 2, 3]));
		$this->assertSame(2, Dash\pop(['a' => 1, 'b' => 2]));
		$this->assertNull(Dash\pop([]));
		$this->assertNull(Dash\pop(null));
	}

	public function testCurried()
	{
		$pop = Dash\Curry\pop();
		$this->assertSame(3, $pop([1, 2, 3]));
	}
}
