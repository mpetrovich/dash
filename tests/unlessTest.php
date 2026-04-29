<?php

/**
 * @covers Dash\unless
 */
class unlessTest extends PHPUnit\Framework\TestCase
{
	public function testAppliesOnFalseBranch()
	{
		$doubleUnlessEven = Dash\unless('Dash\isEven', function ($n) {
			return $n * 2;
		});

		$this->assertSame(2, $doubleUnlessEven(2));
		$this->assertSame(6, $doubleUnlessEven(3));
	}
}
