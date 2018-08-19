<?php

/**
 * @covers Dash\negate
 * @covers Dash\_negate
 */
class negateTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$isEven = function ($n) { return $n % 2 === 0; };
		$isOdd = Dash\negate($isEven);

		$this->assertFalse($isEven(3));
		$this->assertTrue($isOdd(3));
	}

	public function testCurried()
	{
		$isEven = function ($n) { return $n % 2 === 0; };
		$isOdd = Dash\_negate();
		$isOdd2 = $isOdd($isEven);

		$this->assertFalse($isEven(3));
		$this->assertTrue($isOdd2(3));
	}

	public function testExamples()
	{
		$isEven = function ($n) { return $n % 2 === 0; };
		$isOdd = Dash\negate($isEven);

		$this->assertSame(false, $isEven(3));
		$this->assertSame(true, $isOdd(3));
	}
}
