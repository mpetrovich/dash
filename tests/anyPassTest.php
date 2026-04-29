<?php

/**
 * @covers Dash\anyPass
 * @covers Dash\overSome
 */
class anyPassTest extends PHPUnit\Framework\TestCase
{
	public function testAnyPass()
	{
		$fn = Dash\anyPass([
			function ($n) { return $n < 0; },
			function ($n) { return $n % 2 === 0; },
		]);

		$this->assertTrue($fn(4));
		$this->assertFalse($fn(3));
	}

	public function testAlias()
	{
		$predicates = [
			function ($n) { return $n < 0; },
			function ($n) { return $n < 10; },
		];

		$this->assertTrue(Dash\overSome($predicates)(3));
	}

	public function testShortCircuits()
	{
		$calls = 0;
		$fn = Dash\anyPass([
			function () {
				return true;
			},
			function () use (&$calls) {
				$calls++;
				return false;
			},
		]);

		$this->assertTrue($fn('x'));
		$this->assertSame(0, $calls);
	}
}
