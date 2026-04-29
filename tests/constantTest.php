<?php

/**
 * @covers Dash\constant
 */
class constantTest extends PHPUnit\Framework\TestCase
{
	public function testAlwaysReturnsSameValue()
	{
		$fn = Dash\constant(42);
		$this->assertSame(42, $fn());
		$this->assertSame(42, $fn('ignored'));
	}
}
