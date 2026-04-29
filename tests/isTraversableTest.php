<?php

/**
 * @covers Dash\isTraversable
 * @covers Dash\Curry\isTraversable
 */
class isTraversableTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isTraversable($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isTraversable = Dash\Curry\isTraversable();
		$this->assertSame($expected, $isTraversable($value));
	}

	public function cases()
	{
		return [
			[[], true],
			[new ArrayObject([]), true],
			[(object) [], false],
			['hello', false],
		];
	}
}
