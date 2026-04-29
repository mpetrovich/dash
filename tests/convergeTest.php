<?php

/**
 * @covers Dash\converge
 */
class convergeTest extends PHPUnit\Framework\TestCase
{
	public function testConvergesBranchesIntoCombiner()
	{
		$avg = Dash\converge(function ($sum, $count) {
			return $sum / $count;
		}, [
			'Dash\sum',
			'Dash\size',
		]);

		$this->assertSame(4, $avg([2, 4, 6]));
	}

	public function testPassesThroughMultipleArgs()
	{
		$fn = Dash\converge(function ($a, $b) {
			return "$a|$b";
		}, [
			function ($x, $y) { return $x + $y; },
			function ($x, $y) { return $x * $y; },
		]);

		$this->assertSame('5|6', $fn(2, 3));
	}
}
