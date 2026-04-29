<?php

/**
 * @covers Dash\when
 */
class whenTest extends PHPUnit\Framework\TestCase
{
	public function testAppliesOnTrueBranch()
	{
		$doubleWhenEven = Dash\when('Dash\isEven', function ($n) {
			return $n * 2;
		});

		$this->assertSame(8, $doubleWhenEven(4));
		$this->assertSame(3, $doubleWhenEven(3));
	}
}
