<?php

/**
 * @covers Dash\product
 * @covers Dash\Curry\product
 */
class productTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(24, Dash\product([2, 3, 4]));
		$this->assertSame(1, Dash\product([]));
		$this->assertSame(1, Dash\product(null));
	}

	public function testCurried()
	{
		$product = Dash\Curry\product();
		$this->assertSame(24, $product([2, 3, 4]));
	}
}
