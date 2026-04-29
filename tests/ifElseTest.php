<?php

/**
 * @covers Dash\ifElse
 */
class ifElseTest extends PHPUnit\Framework\TestCase
{
	public function testBranchesByPredicate()
	{
		$fn = Dash\ifElse(
			function ($n) { return $n >= 0; },
			function ($n) { return "pos:$n"; },
			function ($n) { return "neg:$n"; }
		);

		$this->assertSame('pos:2', $fn(2));
		$this->assertSame('neg:-3', $fn(-3));
	}

	public function testPassesAllArgs()
	{
		$fn = Dash\ifElse(
			function ($a, $b) { return $a > $b; },
			function ($a, $b) { return $a - $b; },
			function ($a, $b) { return $b - $a; }
		);

		$this->assertSame(3, $fn(5, 2));
		$this->assertSame(3, $fn(2, 5));
	}
}
