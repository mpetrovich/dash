<?php

/**
 * @covers Dash\unzip
 * @covers Dash\transpose
 * @covers Dash\Curry\unzip
 * @covers Dash\Curry\transpose
 */
class unzipTest extends PHPUnit\Framework\TestCase
{
	public function testRoundTripWithZip()
	{
		$a = [1, 2, 3];
		$b = [10, 20, 30];
		$this->assertSame([$a, $b], Dash\unzip(Dash\zip($a, $b)));
	}

	public function testTransposeAlias()
	{
		$matrix = [[1, 10], [2, 20], [3, 30]];
		$this->assertSame(Dash\unzip($matrix), Dash\transpose($matrix));
	}

	public function testNullAndEmpty()
	{
		$this->assertSame([], Dash\unzip(null));
		$this->assertSame([], Dash\unzip([]));
	}

	public function testCurried()
	{
		$unzip = Dash\Curry\unzip();
		$this->assertSame([[1, 2], [10, 20]], $unzip([[1, 10], [2, 20]]));

		$transpose = Dash\Curry\transpose();
		$this->assertSame([[1, 2], [10, 20]], $transpose([[1, 10], [2, 20]]));
	}
}
