<?php

/**
 * @covers Dash\omitBy
 * @covers Dash\Curry\omitBy
 * @covers Dash\Generator\omitBy
 */
class omitByTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$input = [0 => 1, 1 => 2, 2 => 3, 3 => 4];
		$this->assertSame([0 => 1, 2 => 3], Dash\omitBy($input, 'Dash\isEven'));
	}

	public function testCurried()
	{
		$f = Dash\Curry\omitBy('Dash\isEven');
		$this->assertSame(['a' => 1, 'c' => 3], $f(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]));
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 3;
		})();

		$result = Dash\omitBy($iterable, 'Dash\isEven');
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame(['a' => 1, 'c' => 3], iterator_to_array($result));
	}
}
