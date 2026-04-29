<?php

/**
 * @covers Dash\isNumber
 * @covers Dash\Curry\isNumber
 */
class isNumberTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isNumber($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isNumber = Dash\Curry\isNumber();
		$this->assertSame($expected, $isNumber($value));
	}

	public function cases()
	{
		return [
			[0, true],
			[3.14, true],
			['42', false],
			[null, false],
			[false, false],
		];
	}
}
