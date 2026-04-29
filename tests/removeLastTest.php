<?php

/**
 * @covers Dash\removeLast
 * @covers Dash\Curry\removeLast
 */
class removeLastTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([1, 2, 3], Dash\removeLast([1, 2, 3, 2], function ($v) {
			return $v === 2;
		}));
		$this->assertSame(['a' => 1, 'b' => 2], Dash\removeLast(['a' => 1, 'b' => 2, 'c' => 3], 'Dash\isOdd'));
	}

	public function testCurried()
	{
		$removeLastEven = Dash\Curry\removeLast('Dash\isEven');
		$this->assertSame([1, 2, 3], $removeLastEven([1, 2, 3, 2]));
	}
}
