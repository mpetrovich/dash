<?php

class negateTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$isPositive = function ($value) {
			return $value > 0;
		};
		$isNotPositive = Dash\negate($isPositive);

		$this->assertSame(true, $isPositive(3));
		$this->assertSame(false, $isNotPositive(3));
	}
}
