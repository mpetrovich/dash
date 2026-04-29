<?php

/**
 * @covers Dash\remove
 * @covers Dash\Curry\remove
 */
class removeTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([1, 3], Dash\remove([1, 2, 3, 4], 'Dash\isEven'));
		$this->assertSame(['a' => 1], Dash\remove(['a' => 1, 'b' => 2], 'Dash\isEven'));
	}

	public function testCurried()
	{
		$removeEven = Dash\Curry\remove('Dash\isEven');
		$this->assertSame([1, 3], $removeEven([1, 2, 3, 4]));
	}
}
