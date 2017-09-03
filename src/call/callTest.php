<?php

/**
 * @covers Dash\call
 */
class callTest extends PHPUnit_Framework_TestCase
{
	public function testWithNoArgs()
	{
		$func = function () {
			$this->assertSame([], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertSame(0, Dash\call($func));
	}

	public function testWithOneArg()
	{
		$func = function () {
			$this->assertSame([3], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertSame(3, Dash\call($func, 3));
	}

	public function testWithSeveralArgs()
	{
		$func = function () {
			$this->assertSame([1, 2, 3, 4], func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertSame(10, Dash\call($func, 1, 2, 3, 4));
	}

	public function testExamples()
	{
		$func = function ($time, $name) {
			return "Good $time, $name";
		};
		$this->assertSame('Good morning, John', Dash\call($func, 'morning', 'John'));
	}
}
