<?php

/**
 * @covers Dash\isResource
 * @covers Dash\Curry\isResource
 */
class isResourceTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isResource($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isResource = Dash\Curry\isResource();
		$this->assertSame($expected, $isResource($value));
	}

	public function cases()
	{
		return [
			[tmpfile(), true],
			['resource', false],
			[null, false],
		];
	}
}
