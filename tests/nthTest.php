<?php

/**
 * @covers Dash\nth
 * @covers Dash\Curry\nth
 */
class nthTest extends PHPUnit\Framework\TestCase
{
	public function testPositiveIndex()
	{
		$this->assertSame(20, Dash\nth([10, 20, 30], 1));
	}

	public function testNegativeIndex()
	{
		$this->assertSame(10, Dash\nth([10, 20, 30], -3));
		$this->assertSame(30, Dash\nth([10, 20, 30], -1));
	}

	public function testOutOfBounds()
	{
		$this->assertNull(Dash\nth([1, 2], 5));
		$this->assertSame('x', Dash\nth([1, 2], 5, 'x'));
	}

	public function testNullIterable()
	{
		$this->assertNull(Dash\nth(null, 0));
	}

	public function testCurried()
	{
		$f = Dash\Curry\nth(-1, null);
		$this->assertSame(30, $f([10, 20, 30]));
	}
}
