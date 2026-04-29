<?php

/**
 * @covers Dash\zipWith
 * @covers Dash\Generator\zipWith
 * @covers Dash\Curry\zipWith
 */
class zipWithTest extends PHPUnit\Framework\TestCase
{
	public function testArrays()
	{
		$result = Dash\zipWith(
			[1, 2, 3],
			[10, 20, 30],
			function ($a, $b) {
				return $a + $b;
			}
		);
		$this->assertSame([11, 22, 33], $result);
	}

	public function testGenerator()
	{
		$a = (function () {
			yield 1;
			yield 2;
		})();
		$b = [10, 20, 30];

		$result = Dash\zipWith($a, $b, function ($x, $y) {
			return $x + $y;
		});

		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame([11, 22], iterator_to_array($result, false));
	}

	public function testCurried()
	{
		$sumPairs = Dash\Curry\zipWith(function ($a, $b) {
			return $a + $b;
		});

		$this->assertSame([11, 22], $sumPairs([1, 2], [10, 20]));
	}
}
