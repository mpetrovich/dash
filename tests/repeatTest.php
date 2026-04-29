<?php

/**
 * @covers Dash\repeat
 * @covers Dash\Curry\repeat
 * @covers Dash\Generator\repeat
 */
class repeatTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(['a', 'a', 'a'], Dash\repeat('a', 3));
		$this->assertSame([], Dash\repeat('a', 0));
		$this->assertSame([], Dash\repeat('a', -2));
	}

	public function testCurried()
	{
		$f = Dash\Curry\repeat(3);
		$this->assertSame(['x', 'x', 'x'], $f('x'));
	}

	public function testGenerator()
	{
		$result = Dash\Generator\repeat('z', 3);

		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame(['z', 'z', 'z'], iterator_to_array($result, false));
	}
}
