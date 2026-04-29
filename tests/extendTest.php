<?php

/**
 * @covers Dash\extend
 */
class extendTest extends PHPUnit\Framework\TestCase
{
	public function testAliasOfMerge()
	{
		$this->assertSame(
			Dash\merge(['a' => 1], ['a' => 2, 'b' => 3]),
			Dash\extend(['a' => 1], ['a' => 2, 'b' => 3])
		);
	}
}
