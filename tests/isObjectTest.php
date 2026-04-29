<?php

/**
 * @covers Dash\isObject
 * @covers Dash\Curry\isObject
 */
class isObjectTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isObject($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isObject = Dash\Curry\isObject();
		$this->assertSame($expected, $isObject($value));
	}

	public function cases()
	{
		return [
			[(object) [], true],
			[new ArrayObject([]), true],
			[[], false],
			['obj', false],
		];
	}
}
