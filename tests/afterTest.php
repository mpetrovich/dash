<?php

/**
 * @covers Dash\after
 */
class afterTest extends PHPUnit\Framework\TestCase
{
	public function testInvokesOnlyAfterThreshold()
	{
		$counter = 0;
		$fn = Dash\after(3, function ($x) use (&$counter) {
			$counter++;
			return $x * 2;
		});

		$this->assertNull($fn(2));
		$this->assertNull($fn(2));
		$this->assertSame(4, $fn(2));
		$this->assertSame(4, $fn(2));
		$this->assertSame(2, $counter);
	}
}
