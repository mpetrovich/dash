<?php

/**
 * @covers Dash\pad
 * @covers Dash\Curry\pad
 */
class padTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([0, 1, 2, 3, 0], Dash\pad([1, 2, 3], 5, 0));
		$this->assertSame([0, 1, 2, 3, 0, 0], Dash\pad([1, 2, 3], 6, 0));
		$this->assertSame([1, 2, 3], Dash\pad([1, 2, 3], 2, 0));
		$this->assertSame([null, null], Dash\pad(null, 2));
	}

	public function testCurried()
	{
		$f = Dash\Curry\pad(5, 0);
		$this->assertSame([0, 1, 2, 3, 0], $f([1, 2, 3]));
	}
}
