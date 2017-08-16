<?php

/**
 * @covers Dash\chain
 */
class chainTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$chain = Dash\chain([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertEquals([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertEquals([2, 4, 6], $chain->value());
	}
}
