<?php

/**
 * @covers Dash\sortKeys
 * @covers Dash\Curry\sortKeys
 */
class sortKeysTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(['a' => 1, 'b' => 2, 'c' => 3], Dash\sortKeys(['c' => 3, 'a' => 1, 'b' => 2]));
		$this->assertSame([], Dash\sortKeys(null));
	}

	public function testCurried()
	{
		$sortKeys = Dash\Curry\sortKeys();
		$this->assertSame(['a' => 1, 'b' => 2], $sortKeys(['b' => 2, 'a' => 1]));
	}
}
