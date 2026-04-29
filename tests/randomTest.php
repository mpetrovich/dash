<?php

/**
 * @covers Dash\random
 * @covers Dash\Curry\random
 */
class randomTest extends PHPUnit\Framework\TestCase
{
	public function testSingleArgumentUsesZeroAsMin()
	{
		for ($i = 0; $i < 20; $i++) {
			$value = Dash\random(3);
			$this->assertGreaterThanOrEqual(0, $value);
			$this->assertLessThanOrEqual(3, $value);
		}
	}

	public function testMinMaxRange()
	{
		for ($i = 0; $i < 20; $i++) {
			$value = Dash\random(2, 4);
			$this->assertGreaterThanOrEqual(2, $value);
			$this->assertLessThanOrEqual(4, $value);
		}
	}

	public function testCurried()
	{
		for ($i = 0; $i < 20; $i++) {
			$value = Dash\Curry\random(2, 4);
			$this->assertGreaterThanOrEqual(2, $value);
			$this->assertLessThanOrEqual(4, $value);
		}
	}
}
