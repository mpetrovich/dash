<?php

/**
 * @covers Dash\invert
 * @covers Dash\invertObj
 * @covers Dash\Curry\invert
 * @covers Dash\Curry\invertObj
 */
class invertTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(['1' => 'a', '2' => 'b'], Dash\invert(['a' => 1, 'b' => 2]));
		$this->assertSame(['1' => 'a', '2' => 'b'], Dash\invertObj(['a' => 1, 'b' => 2]));
	}

	public function testCurried()
	{
		$invert = Dash\Curry\invert();
		$this->assertSame(['1' => 'a', '2' => 'b'], $invert(['a' => 1, 'b' => 2]));

		$invertObj = Dash\Curry\invertObj();
		$this->assertSame(['1' => 'a', '2' => 'b'], $invertObj(['a' => 1, 'b' => 2]));
	}

	public function testDuplicateValuesOverwrite()
	{
		$this->assertSame(['1' => 'b'], Dash\invert(['a' => 1, 'b' => 1]));
	}
}
