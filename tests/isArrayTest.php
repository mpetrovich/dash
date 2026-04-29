<?php

/**
 * @covers Dash\isArray
 * @covers Dash\Curry\isArray
 */
class isArrayTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isArray($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isArray = Dash\Curry\isArray();
		$this->assertSame($expected, $isArray($value));
	}

	public function cases()
	{
		return [
			[[], true],
			[[1, 2, 3], true],
			[(object) [], false],
			['a', false],
			[null, false],
		];
	}
}
