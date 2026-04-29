<?php

/**
 * @covers Dash\mixin
 * @covers Dash\setCustom
 */
class mixinTest extends PHPUnit\Framework\TestCase
{
	public function tearDown(): void
	{
		Dash\Dash::unsetCustom('double');
	}

	public function testSetCustomFunctionWrapper()
	{
		Dash\setCustom('double', function ($n) {
			return $n * 2;
		});

		$this->assertSame(6, Dash\Dash::double(3));
	}

	public function testMixinAlias()
	{
		Dash\mixin('double', function ($n) {
			return $n * 2;
		});

		$this->assertSame(6, Dash\Dash::double(3));
	}
}
