<?php

/**
 * @covers Dash\toPairs
 * @covers Dash\pairs
 * @covers Dash\Curry\toPairs
 */
class toPairsTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([['a', 1], ['b', 2]], Dash\toPairs(['a' => 1, 'b' => 2]));
		$this->assertSame([[0, 'x'], [1, 'y']], Dash\toPairs(['x', 'y']));
		$this->assertSame([], Dash\toPairs(null));
	}

	public function testAlias()
	{
		$this->assertSame([['a', 1], ['b', 2]], Dash\pairs(['a' => 1, 'b' => 2]));
	}

	public function testCurried()
	{
		$f = Dash\Curry\toPairs();
		$this->assertSame([['a', 1]], $f(['a' => 1]));
	}
}
