<?php

/**
 * @covers Dash\custom
 * @covers Dash\Curry\custom
 */
class customTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		Dash\Dash::setCustom('double', function ($value) {
			return $value * 2;
		});

		$double = Dash\custom('double');
		$this->assertSame(6, $double(3));

		$this->assertSame(
			[2, 4, 6],
			Dash\chain([1, 2, 3])->map(Dash\custom('double'))->value()
		);

		Dash\Dash::unsetCustom('double');
	}

	public function testCurried()
	{
		Dash\Dash::setCustom('double', function ($value) {
			return $value * 2;
		});

		$custom = Dash\Curry\custom();
		$double = $custom('double');
		$this->assertSame(6, $double(3));

		$this->assertSame(
			[2, 4, 6],
			Dash\chain([1, 2, 3])->map($custom('double'))->value()
		);

		Dash\Dash::unsetCustom('double');
	}

	public function testNumberOfArgsPreserved()
	{
		$fn = function ($a, $b, $c) {
		};
		Dash\Dash::setCustom('customTest__fn', $fn);

		$custom = Dash\custom('customTest__fn');
		$numArgs = (new ReflectionFunction($custom))->getNumberOfParameters();

		$this->assertSame(3, $numArgs);
	}
}
