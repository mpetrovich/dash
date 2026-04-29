<?php

/**
 * @covers Dash\isNaN
 * @covers Dash\Curry\isNaN
 */
class isNaNTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isNaN($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isNaN = Dash\Curry\isNaN();
		$this->assertSame($expected, $isNaN($value));
	}

	public function cases()
	{
		return [
			[NAN, true],
			[3.14, false],
			[INF, false],
			[0, false],
			['NaN', false],
		];
	}
}
