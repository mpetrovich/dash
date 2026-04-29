<?php

/**
 * @covers Dash\juxt
 * @covers Dash\over
 */
class juxtTest extends PHPUnit\Framework\TestCase
{
	public function testJuxt()
	{
		$fn = Dash\juxt([
			function ($n) { return $n + 1; },
			function ($n) { return $n * 2; },
		]);

		$this->assertSame([4, 6], $fn(3));
	}

	public function testAlias()
	{
		$fn = Dash\over([
			function ($a, $b) { return $a + $b; },
			function ($a, $b) { return $a * $b; },
		]);

		$this->assertSame([5, 6], $fn(2, 3));
	}
}
