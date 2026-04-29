<?php

/**
 * @covers Dash\append
 * @covers Dash\unpop
 */
class appendTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame([1, 2, 3, 4], Dash\append([1, 2], 3, 4));
		$this->assertSame([1, 2], Dash\append(null, 1, 2));
	}

	public function testAlias()
	{
		$this->assertSame([1, 2, 3], Dash\unpop([1], 2, 3));
	}
}
