<?php

/**
 * @covers Dash\shuffle
 * @covers Dash\randomize
 * @covers Dash\Curry\shuffle
 */
class shuffleTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$input = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
		$result = Dash\shuffle($input);

		$this->assertSame([1, 2, 3, 4], Dash\sort($result));
		$this->assertSame([0, 1, 2, 3], array_keys($result));
	}

	public function testAlias()
	{
		$this->assertSame(
			Dash\sort(Dash\shuffle([1, 2, 3])),
			Dash\sort(Dash\randomize([1, 2, 3]))
		);
	}

	public function testCurried()
	{
		$shuffle = Dash\Curry\shuffle();
		$result = $shuffle([1, 2, 3]);
		$this->assertSame([1, 2, 3], Dash\sort($result));
	}
}
