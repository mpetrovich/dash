<?php

/**
 * @covers Dash\defaults
 */
class defaultsTest extends PHPUnit\Framework\TestCase
{
	public function testUsesFirstDefinedSourceValue()
	{
		$result = Dash\defaults(
			['a' => null, 'b' => 2],
			['a' => 1, 'b' => 20, 'c' => 3],
			['a' => 10, 'c' => 30, 'd' => 4]
		);

		$this->assertSame(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], $result);
	}

	public function testSkipsNullSourceValues()
	{
		$result = Dash\defaults(
			['a' => null],
			['a' => null],
			['a' => 2]
		);

		$this->assertSame(['a' => 2], $result);
	}

	public function testNullInput()
	{
		$this->assertSame(['a' => 1], Dash\defaults(null, ['a' => 1]));
	}
}
