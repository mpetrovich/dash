<?php

/**
 * @covers Dash\scan
 * @covers Dash\Curry\scan
 * @covers Dash\Generator\scan
 */
class scanTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$sum = function ($acc, $value) {
			return $acc + $value;
		};

		$this->assertSame([0, 1, 3, 6], Dash\scan([1, 2, 3], $sum, 0));
		$this->assertSame([0], Dash\scan([], $sum, 0));
		$this->assertSame([0], Dash\scan(null, $sum, 0));
	}

	public function testCurried()
	{
		$sum = function ($acc, $value) {
			return $acc + $value;
		};

		$scan = Dash\Curry\scan($sum, 0);
		$this->assertSame([0, 1, 3, 6], $scan([1, 2, 3]));
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 1;
			yield 2;
			yield 3;
		})();

		$sum = function ($acc, $value) {
			return $acc + $value;
		};

		$result = Dash\scan($iterable, $sum, 0);

		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame([0, 1, 3, 6], iterator_to_array($result, false));
	}
}
