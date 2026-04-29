<?php

/**
 * @covers Dash\isBoolean
 * @covers Dash\Curry\isBoolean
 */
class isBooleanTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isBoolean($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isBoolean = Dash\Curry\isBoolean();
		$this->assertSame($expected, $isBoolean($value));
	}

	public function cases()
	{
		return [
			[true, true],
			[false, true],
			[0, false],
			['false', false],
			[null, false],
		];
	}
}
