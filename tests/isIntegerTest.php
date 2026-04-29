<?php

/**
 * @covers Dash\isInteger
 * @covers Dash\Curry\isInteger
 */
class isIntegerTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isInteger($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isInteger = Dash\Curry\isInteger();
		$this->assertSame($expected, $isInteger($value));
	}

	public function cases()
	{
		return [
			[0, true],
			[-4, true],
			[3.14, false],
			['1', false],
			[null, false],
		];
	}
}
