<?php

/**
 * @covers Dash\merge
 */
class mergeTest extends PHPUnit\Framework\TestCase
{
	public function testLaterSourcesOverrideEarlier()
	{
		$result = Dash\merge(
			['a' => 1, 'b' => 2],
			['b' => 20, 'c' => 3],
			['c' => 30, 'd' => 4]
		);

		$this->assertSame(['a' => 1, 'b' => 20, 'c' => 30, 'd' => 4], $result);
	}

	public function testNullInputs()
	{
		$this->assertSame([], Dash\merge(null));
		$this->assertSame(['a' => 1], Dash\merge(null, ['a' => 1]));
	}
}
