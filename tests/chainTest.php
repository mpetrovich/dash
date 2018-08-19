<?php

/**
 * @covers Dash\chain
 * @covers Dash\Curry\chain
 */
class chainTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$chain = Dash\chain([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	public function testCurried()
	{
		$chain = Dash\Curry\chain();
		$chain = $chain([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	public function testExamples()
	{
		$result = Dash\chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; })
			->value();

		$this->assertSame([2, 4], $result);
	}
}
