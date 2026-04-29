<?php

/**
 * @covers Dash\evolve
 * @covers Dash\Curry\evolve
 */
class evolveTest extends PHPUnit\Framework\TestCase
{
	public function testArray()
	{
		$input = ['a' => 1, 'b' => 2, 'c' => 3];
		$tx = [
			'a' => function ($v) { return $v + 10; },
			'c' => function ($v) { return $v * 2; },
		];

		$this->assertSame(['a' => 11, 'b' => 2, 'c' => 6], Dash\evolve($input, $tx));
	}

	public function testCurried()
	{
		$tx = [
			'a' => function ($v) { return $v + 10; },
		];

		$f = Dash\Curry\evolve($tx);
		$this->assertSame(['a' => 11, 'b' => 2], $f(['a' => 1, 'b' => 2]));
	}

	public function testStdClassOutput()
	{
		$input = (object) ['a' => 1, 'b' => 2];
		$tx = [
			'b' => function ($v) { return $v + 5; },
		];

		$result = Dash\evolve($input, $tx);

		$this->assertInstanceOf(stdClass::class, $result);
		$this->assertEquals((object) ['a' => 1, 'b' => 7], $result);
	}
}
