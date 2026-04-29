<?php

/**
 * @covers Dash\findIndex
 * @covers Dash\Curry\findIndex
 */
class findIndexTest extends PHPUnit\Framework\TestCase
{
	public function testFound()
	{
		$this->assertSame(1, Dash\findIndex([1, 2, 3], 'Dash\isEven'));
	}

	public function testNotFound()
	{
		$this->assertSame(-1, Dash\findIndex([1, 3, 5], 'Dash\isEven'));
	}

	public function testNullIterable()
	{
		$this->assertSame(-1, Dash\findIndex(null, 'Dash\identity'));
	}

	public function testAssociativeCountsPosition()
	{
		$this->assertSame(1, Dash\findIndex(['a' => 1, 'b' => 2, 'c' => 3], function ($v) {
			return $v === 2;
		}));
	}

	public function testCurried()
	{
		$f = Dash\Curry\findIndex('Dash\isEven');
		$this->assertSame(1, $f([1, 2, 3]));
	}
}
