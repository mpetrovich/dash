<?php

/**
 * @covers Dash\partial
 */
class partialTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		// With no fixed args
		$partial = Dash\partial($callable);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2, 3, 4));

		// With one fixed arg
		$partial = Dash\partial($callable, 1);
		$this->assertSame('1, 2, 3, 4', $partial(2, 3, 4));

		// With several fixed args
		$partial = Dash\partial($callable, 1, 2);
		$this->assertSame('1, 2, 3, 4', $partial(3, 4));

		// With only fixed args
		$partial = Dash\partial($callable, 1, 2, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial());
	}

	public function testPlaceholders()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		// With one placeholder
		$partial = Dash\partial($callable, Dash\_, 2, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial(1));

		// With several placeholders
		$partial = Dash\partial($callable, 1, Dash\_, 3, Dash\_);
		$this->assertSame('1, 2, 3, 4', $partial(2, 4));

		// With several placeholders
		$partial = Dash\partial($callable, 1, Dash\_, 3, Dash\_);
		$this->assertSame('1, 2, 3, 4, 5, 6', $partial(2, 4, 5, 6));

		// With only placeholders
		$partial = Dash\partial($callable, Dash\_, Dash\_, Dash\_, Dash\_);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2, 3, 4));
	}

	public function testExamples()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};

		$sayHello = Dash\partial($greet, 'Hello');
		$sayHowdy = Dash\partial($greet, 'Howdy');

		$this->assertSame('Hello, Mark!', $sayHello('Mark'));
		$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));

		$greetMark = Dash\partial($greet, Dash\_, 'Mark');
		$greetJane = Dash\partial($greet, Dash\_, 'Jane');

		$this->assertSame('Hello, Mark!', $greetMark('Hello'));
		$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));
	}
}
