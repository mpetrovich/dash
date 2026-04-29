<?php

/**
 * @covers Dash\sample
 * @covers Dash\Curry\sample
 */
class sampleTest extends PHPUnit\Framework\TestCase
{
	public function testReturnsNullForEmpty()
	{
		$this->assertNull(Dash\sample([]));
		$this->assertNull(Dash\sample(null));
	}

	public function testReturnsValueFromInput()
	{
		$input = [10, 20, 30];
		$this->assertContains(Dash\sample($input), $input);
	}

	public function testCurried()
	{
		$input = [10, 20, 30];
		$sample = Dash\Curry\sample();
		$this->assertContains($sample($input), $input);
	}
}
