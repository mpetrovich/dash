<?php

/**
 * @covers Dash\splice
 * @covers Dash\Curry\splice
 */
class spliceTest extends PHPUnit\Framework\TestCase
{
	public function testReturnsRemovedSegment()
	{
		$this->assertSame([2, 3], Dash\splice([1, 2, 3, 4], 1, 2));
		$this->assertSame([3, 4], Dash\splice([1, 2, 3, 4], 2));
	}

	public function testCurried()
	{
		$splice = Dash\Curry\splice(1, 2, []);
		$this->assertSame([2, 3], $splice([1, 2, 3, 4]));
	}
}
