<?php

/**
 * @covers Dash\memoize
 */
class memoizeTest extends PHPUnit\Framework\TestCase
{
	public function testCachesByArguments()
	{
		$count = 0;
		$square = Dash\memoize(function ($n) use (&$count) {
			$count++;
			return $n * $n;
		});

		$this->assertSame(9, $square(3));
		$this->assertSame(9, $square(3));
		$this->assertSame(16, $square(4));
		$this->assertSame(2, $count);
	}

	public function testCachesNullResult()
	{
		$count = 0;
		$f = Dash\memoize(function ($n) use (&$count) {
			$count++;
			return null;
		});

		$this->assertNull($f(1));
		$this->assertNull($f(1));
		$this->assertSame(1, $count);
	}
}
