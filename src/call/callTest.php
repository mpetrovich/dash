<?php

/**
 * @covers Dash\call
 */
class callTest extends PHPUnit_Framework_TestCase
{
	public function testWithNoArgs()
	{
		$func = function () {
			$this->assertEquals([], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertEquals(0, Dash\call($func));
	}

	public function testWithOneArg()
	{
		$func = function () {
			$this->assertEquals([3], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertEquals(3, Dash\call($func, 3));
	}

	public function testWithSeveralArgs()
	{
		$func = function () {
			$this->assertEquals([1, 2, 3, 4], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertEquals(10, Dash\call($func, 1, 2, 3, 4));
	}
}
