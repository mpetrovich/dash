<?php

/**
 * @covers Dash\custom
 */
class customTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		Dash\_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertEquals(
			[2, 4, 6],
			Dash\_::chain([1, 2, 3])->map(Dash\custom('double'))->value()
		);

		Dash\_::unsetCustom('double');
	}
}
