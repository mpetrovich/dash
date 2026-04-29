<?php

/**
 * @covers Dash\isDate
 * @covers Dash\Curry\isDate
 */
class isDateTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isDate($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isDate = Dash\Curry\isDate();
		$this->assertSame($expected, $isDate($value));
	}

	public function cases()
	{
		return [
			[new DateTime(), true],
			[new DateTimeImmutable(), true],
			['2020-01-01', false],
			[time(), false],
			[null, false],
		];
	}
}
