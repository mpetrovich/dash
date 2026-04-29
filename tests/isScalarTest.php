<?php

/**
 * @covers Dash\isScalar
 * @covers Dash\Curry\isScalar
 */
class isScalarTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isScalar($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isScalar = Dash\Curry\isScalar();
		$this->assertSame($expected, $isScalar($value));
	}

	public function cases()
	{
		return [
			[1, true],
			['hello', true],
			[false, true],
			[3.14, true],
			[null, false],
			[[], false],
		];
	}
}
