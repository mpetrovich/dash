<?php

/**
 * @covers Dash\lastIndexOf
 * @covers Dash\Curry\lastIndexOf
 */
class lastIndexOfTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(3, Dash\lastIndexOf([1, 2, 1, 2], 2));
		$this->assertSame(-1, Dash\lastIndexOf([1, 2, 3], 9));
		$this->assertSame(2, Dash\lastIndexOf([1, 2, 1, 2], 1, 2));
		$this->assertSame(0, Dash\lastIndexOf([1, 2, 1, 2], 1, -3));
	}

	public function testWithComparator()
	{
		$strict = 'Dash\identical';
		$this->assertSame(2, Dash\lastIndexOf([1, '2', 2], 2, null, $strict));
	}

	public function testCurried()
	{
		$f = Dash\Curry\lastIndexOf(2, null, 'Dash\equal');
		$this->assertSame(3, $f([1, 2, 1, 2]));
	}
}
