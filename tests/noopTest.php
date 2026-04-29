<?php

/**
 * @covers Dash\noop
 */
class noopTest extends PHPUnit\Framework\TestCase
{
	public function testAlwaysReturnsNull()
	{
		$this->assertNull(Dash\noop());
		$this->assertNull(call_user_func_array('Dash\noop', [1, 2, 3]));
	}
}
