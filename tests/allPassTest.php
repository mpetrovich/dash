<?php

/**
 * @covers Dash\allPass
 * @covers Dash\overEvery
 */
class allPassTest extends PHPUnit\Framework\TestCase
{
	public function testAllPass()
	{
		$fn = Dash\allPass([
			function ($n) { return $n > 0; },
			function ($n) { return $n % 2 === 0; },
		]);

		$this->assertTrue($fn(4));
		$this->assertFalse($fn(3));
	}

	public function testAlias()
	{
		$predicates = [
			function ($n) { return $n > 0; },
			function ($n) { return $n < 10; },
		];

		$this->assertTrue(Dash\overEvery($predicates)(3));
	}

	public function testShortCircuits()
	{
		$calls = 0;
		$fn = Dash\allPass([
			function () {
				return false;
			},
			function () use (&$calls) {
				$calls++;
				return true;
			},
		]);

		$this->assertFalse($fn('x'));
		$this->assertSame(0, $calls);
	}
}
