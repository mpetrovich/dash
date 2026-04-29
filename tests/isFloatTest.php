<?php

/**
 * @covers Dash\isFloat
 * @covers Dash\Curry\isFloat
 */
class isFloatTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isFloat($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isFloat = Dash\Curry\isFloat();
		$this->assertSame($expected, $isFloat($value));
	}

	public function cases()
	{
		return [
			[3.14, true],
			[0.0, true],
			[1, false],
			['3.14', false],
			[null, false],
		];
	}
}
