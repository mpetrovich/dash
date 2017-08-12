<?php

use Dash\_;

class negateTest extends PHPUnit_Framework_TestCase
{
	public function testStandaloneNegate()
	{
		$isPositive = function($value) {
			return $value > 0;
		};
		$isNotPositive = Dash\negate($isPositive);

		$this->assertSame(true, $isPositive(3));
		$this->assertSame(false, $isNotPositive(3));
	}

	public function testNegateInChain()
	{
		$isPositive = function($value) {
			return $value > 0;
		};

		$_ = new _(array(2, -3, 5, -8));
		$negatives = $_
			->filter(Dash\negate($isPositive))
			->values()  // Re-indexes the array
			->value();

		$this->assertEquals(array(-3, -8), $negatives);
	}
}
