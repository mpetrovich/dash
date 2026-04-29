<?php

/**
 * @covers Dash\isNull
 * @covers Dash\Curry\isNull
 */
class isNullTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isNull($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isNull = Dash\Curry\isNull();
		$this->assertSame($expected, $isNull($value));
	}

	public function cases()
	{
		return [
			[null, true],
			[0, false],
			['', false],
			[false, false],
		];
	}
}
