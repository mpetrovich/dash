<?php

/**
 * @covers Dash\isRegExp
 * @covers Dash\Curry\isRegExp
 */
class isRegExpTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isRegExp($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isRegExp = Dash\Curry\isRegExp();
		$this->assertSame($expected, $isRegExp($value));
	}

	public function cases()
	{
		return [
			['/foo/', true],
			['#^bar$#', true],
			['foo', false],
			['', false],
			[null, false],
		];
	}
}
