<?php

/**
 * @covers Dash\custom
 * @covers Dash\_custom
 */
class customTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		Dash\_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$double = Dash\custom('double');
		$this->assertSame(6, $double(3));

		$this->assertSame(
			[2, 4, 6],
			Dash\_::chain([1, 2, 3])->map(Dash\custom('double'))->value()
		);

		Dash\_::unsetCustom('double');
	}

	public function testCurried()
	{
		Dash\_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$custom = Dash\_custom();
		$double = $custom('double');
		$this->assertSame(6, $double(3));

		$this->assertSame(
			[2, 4, 6],
			Dash\_::chain([1, 2, 3])->map($custom('double'))->value()
		);

		Dash\_::unsetCustom('double');
	}
}
