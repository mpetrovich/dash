<?php

/**
 * @covers Dash\isFunction
 * @covers Dash\Curry\isFunction
 */
class isFunctionTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isFunction($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isFunction = Dash\Curry\isFunction();
		$this->assertSame($expected, $isFunction($value));
	}

	public function cases()
	{
		return [
			[function () {
			}, true],
			['trim', true],
			[[new DateTime(), 'format'], true],
			['not_a_real_function_name', false],
			[42, false],
		];
	}
}
