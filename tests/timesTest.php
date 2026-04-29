<?php

/**
 * @covers Dash\times
 * @covers Dash\Curry\times
 * @covers Dash\Generator\times
 */
class timesTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([0, 1, 2], Dash\times(3, 'Dash\identity'));
		$this->assertSame([0, 2, 4], Dash\times(3, function ($i) { return $i * 2; }));
		$this->assertSame([], Dash\times(0, 'Dash\identity'));
		$this->assertSame([], Dash\times(-2, 'Dash\identity'));
	}

	public function testCurried()
	{
		$f = Dash\Curry\times(function ($i) { return $i + 1; });
		$this->assertSame([1, 2, 3], $f(3));
	}

	public function testGenerator()
	{
		$result = Dash\Generator\times(3, function ($i) {
			return $i * 3;
		});

		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame([0, 3, 6], iterator_to_array($result, false));
	}
}
