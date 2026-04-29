<?php

/**
 * @covers Dash\indexOf
 * @covers Dash\Curry\indexOf
 */
class indexOfTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(1, Dash\indexOf([1, 2, 3], 2));
		$this->assertSame(-1, Dash\indexOf([1, 2, 3], 9));
		$this->assertSame(2, Dash\indexOf([1, 2, 1, 2], 1, 2));
		$this->assertSame(2, Dash\indexOf([1, 2, 1, 2], 1, -2));
	}

	public function testWithComparator()
	{
		$strict = 'Dash\identical';
		$this->assertSame(2, Dash\indexOf([1, '2', 2], 2, 0, $strict));
	}

	public function testCurried()
	{
		$f = Dash\Curry\indexOf(2, 0, 'Dash\equal');
		$this->assertSame(1, $f([1, 2, 3]));
	}
}
