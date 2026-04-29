<?php

/**
 * @covers Dash\isString
 * @covers Dash\Curry\isString
 */
class isStringTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isString($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isString = Dash\Curry\isString();
		$this->assertSame($expected, $isString($value));
	}

	public function cases()
	{
		return [
			['', true],
			['hello', true],
			[1, false],
			[null, false],
			[[], false],
		];
	}
}
