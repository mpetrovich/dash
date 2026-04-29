<?php

/**
 * @covers Dash\isEqual
 * @covers Dash\Curry\isEqual
 */
class isEqualTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$this->assertSame($expected, Dash\isEqual($a, $b));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($a, $b, $expected)
	{
		$isEqualToB = Dash\Curry\isEqual($b);
		$this->assertSame($expected, $isEqualToB($a));
	}

	public function cases()
	{
		return [
			[1, 1, true],
			[1, '1', true],
			[[1, 2], [1, 2], true],
			[[1, 2], [2, 1], false],
			[null, false, true],
		];
	}
}
