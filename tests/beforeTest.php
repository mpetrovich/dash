<?php

/**
 * @covers Dash\before
 */
class beforeTest extends PHPUnit\Framework\TestCase
{
	public function testInvokesUntilThreshold()
	{
		$counter = 0;
		$fn = Dash\before(3, function ($x) use (&$counter) {
			$counter++;
			return $x * 2;
		});

		$this->assertSame(4, $fn(2));
		$this->assertSame(6, $fn(3));
		$this->assertSame(6, $fn(4));
		$this->assertSame(6, $fn(5));
		$this->assertSame(2, $counter);
	}
}
