<?php

/**
 * @covers Dash\isFinite
 * @covers Dash\Curry\isFinite
 */
class isFiniteTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isFinite($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isFinite = Dash\Curry\isFinite();
		$this->assertSame($expected, $isFinite($value));
	}

	public function cases()
	{
		return [
			[1, true],
			[3.14, true],
			[INF, false],
			[-INF, false],
			[NAN, false],
			['3.14', false],
		];
	}
}
