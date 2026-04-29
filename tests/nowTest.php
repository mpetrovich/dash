<?php

/**
 * @covers Dash\now
 */
class nowTest extends PHPUnit\Framework\TestCase
{
	public function testReturnsMillisecondTimestamp()
	{
		$before = (int) floor(microtime(true) * 1000);
		$value = Dash\now();
		$after = (int) floor(microtime(true) * 1000);

		$this->assertGreaterThanOrEqual($before, $value);
		$this->assertLessThanOrEqual($after, $value);
	}
}
