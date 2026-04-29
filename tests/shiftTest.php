<?php

/**
 * @covers Dash\shift
 * @covers Dash\Curry\shift
 */
class shiftTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(1, Dash\shift([1, 2, 3]));
		$this->assertSame(1, Dash\shift(['a' => 1, 'b' => 2]));
		$this->assertNull(Dash\shift([]));
		$this->assertNull(Dash\shift(null));
	}

	public function testCurried()
	{
		$shift = Dash\Curry\shift();
		$this->assertSame(1, $shift([1, 2, 3]));
	}
}
