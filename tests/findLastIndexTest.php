<?php

/**
 * @covers Dash\findLastIndex
 * @covers Dash\Curry\findLastIndex
 */
class findLastIndexTest extends PHPUnit\Framework\TestCase
{
	public function testLastMatch()
	{
		$this->assertSame(4, Dash\findLastIndex([1, 2, 3, 4, 2], function ($v) {
			return $v === 2;
		}));
	}

	public function testNotFound()
	{
		$this->assertSame(-1, Dash\findLastIndex([1, 3, 5], 'Dash\isEven'));
	}

	public function testNullIterable()
	{
		$this->assertSame(-1, Dash\findLastIndex(null, 'Dash\identity'));
	}

	public function testCurried()
	{
		$f = Dash\Curry\findLastIndex(function ($v) {
			return $v === 2;
		});
		$this->assertSame(4, $f([1, 2, 3, 4, 2]));
	}
}
