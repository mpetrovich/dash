<?php

/**
 * @covers Dash\slice
 * @covers Dash\Curry\slice
 * @covers Dash\Generator\slice
 */
class sliceTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([2, 3], Dash\slice([1, 2, 3, 4], 1, 2));
		$this->assertSame([3, 4], Dash\slice([1, 2, 3, 4], 2));
		$this->assertSame(['b' => 2, 'c' => 3], Dash\slice(['a' => 1, 'b' => 2, 'c' => 3], 1, 2));
		$this->assertSame([3, 4], Dash\slice([1, 2, 3, 4], -2, 2));
	}

	public function testCurried()
	{
		$f = Dash\Curry\slice(1, 2);
		$this->assertSame([2, 3], $f([1, 2, 3, 4]));
	}

	public function testGenerator()
	{
		$generator = function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 3;
			yield 'd' => 4;
		};

		$result = Dash\slice($generator(), 1, 2);
		$this->assertSame(['b' => 2, 'c' => 3], iterator_to_array($result));
	}
}
