<?php

/**
 * @covers Dash\removeFirst
 * @covers Dash\Curry\removeFirst
 */
class removeFirstTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([1, 3, 2], Dash\removeFirst([1, 2, 3, 2], function ($v) {
			return $v === 2;
		}));
		$this->assertSame(['a' => 1, 'c' => 3], Dash\removeFirst(['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isEven'));
	}

	public function testCurried()
	{
		$removeFirstEven = Dash\Curry\removeFirst('Dash\isEven');
		$this->assertSame([1, 3, 2], $removeFirstEven([1, 2, 3, 2]));
	}
}
