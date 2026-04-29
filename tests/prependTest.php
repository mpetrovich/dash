<?php

/**
 * @covers Dash\prepend
 * @covers Dash\unshift
 */
class prependTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([1, 2, 3, 4], Dash\prepend([3, 4], 1, 2));
		$this->assertSame([1, 2], Dash\prepend(null, 1, 2));
	}

	public function testAlias()
	{
		$this->assertSame([1, 2, 3], Dash\unshift([3], 1, 2));
	}
}
