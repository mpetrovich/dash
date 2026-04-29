<?php

/**
 * @covers Dash\uniqueId
 */
class uniqueIdTest extends PHPUnit\Framework\TestCase
{
	public function testGeneratesDistinctIds()
	{
		$a = Dash\uniqueId();
		$b = Dash\uniqueId();
		$this->assertNotSame($a, $b);
	}

	public function testPrefix()
	{
		$id = Dash\uniqueId('item_');
		$this->assertStringStartsWith('item_', $id);
	}
}
