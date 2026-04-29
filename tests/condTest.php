<?php

/**
 * @covers Dash\cond
 */
class condTest extends PHPUnit\Framework\TestCase
{
	public function testDispatchesFirstMatch()
	{
		$fn = Dash\cond([
			[function ($n) { return $n < 0; }, function () { return 'neg'; }],
			[function ($n) { return $n > 0; }, function () { return 'pos'; }],
		]);

		$this->assertSame('neg', $fn(-1));
		$this->assertSame('pos', $fn(2));
		$this->assertNull($fn(0));
	}

	public function testPassesThroughArgs()
	{
		$fn = Dash\cond([
			[
				function ($a, $b) { return $a > $b; },
				function ($a, $b) { return $a - $b; },
			],
		]);

		$this->assertSame(3, $fn(5, 2));
	}

	public function testThrowsForMalformedPair()
	{
		$this->expectException(InvalidArgumentException::class);
		Dash\cond([[function () { return true; }]]);
	}
}
