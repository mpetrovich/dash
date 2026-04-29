<?php

/**
 * @covers Dash\once
 */
class onceTest extends PHPUnit\Framework\TestCase
{
	public function testInvokesOnce()
	{
		$count = 0;
		$next = Dash\once(function ($step = 1) use (&$count) {
			$count += $step;
			return $count;
		});

		$this->assertSame(2, $next(2));
		$this->assertSame(2, $next(100));
		$this->assertSame(2, $next());
		$this->assertSame(2, $count);
	}

	public function testCachesNullResult()
	{
		$count = 0;
		$f = Dash\once(function () use (&$count) {
			$count++;
			return null;
		});

		$this->assertNull($f());
		$this->assertNull($f());
		$this->assertSame(1, $count);
	}
}
