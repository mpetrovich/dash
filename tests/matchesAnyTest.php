<?php

/**
 * @covers Dash\matchesAny
 * @covers Dash\Curry\matchesAny
 */
class matchesAnyTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$users = [
			['name' => 'John', 'active' => false],
			['name' => 'Mary', 'active' => true],
		];

		$this->assertTrue(Dash\matchesAny($users, ['active' => true]));
		$this->assertFalse(Dash\matchesAny($users, ['name' => 'Alice']));
		$this->assertFalse(Dash\matchesAny(null, ['active' => true]));
	}

	public function testCurried()
	{
		$anyActive = Dash\Curry\matchesAny(['active' => true]);
		$this->assertTrue($anyActive([['active' => false], ['active' => true]]));
		$this->assertFalse($anyActive([['active' => false]]));
	}
}
