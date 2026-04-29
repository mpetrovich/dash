<?php

/**
 * @covers Dash\pickBy
 * @covers Dash\Curry\pickBy
 * @covers Dash\Generator\pickBy
 */
class pickByTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$input = [0 => 1, 1 => 2, 2 => 3, 3 => 4];
		$this->assertSame([1 => 2, 3 => 4], Dash\pickBy($input, 'Dash\isEven'));
	}

	public function testCurried()
	{
		$f = Dash\Curry\pickBy('Dash\isEven');
		$this->assertSame(['b' => 2, 'd' => 4], $f(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]));
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 3;
		})();

		$result = Dash\pickBy($iterable, 'Dash\isEven');
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame(['b' => 2], iterator_to_array($result));
	}
}
