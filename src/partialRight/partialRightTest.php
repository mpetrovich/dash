<?php

/**
 * @covers Dash\partialRight
 */
class partialRightTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		// With no fixed args
		$partial = Dash\partialRight($callable);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2, 3, 4));

		// With one fixed arg
		$partial = Dash\partialRight($callable, 4);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2, 3));

		// With some fixed args
		$partial = Dash\partialRight($callable, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2));

		// With only fixed args
		$partial = Dash\partialRight($callable, 1, 2, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial());
	}

	public function testPlaceholders()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		// With one placeholder
		$partial = Dash\partialRight($callable, Dash\_, 2, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial(1));

		// With several placeholders
		$partial = Dash\partialRight($callable, 3, Dash\_, 5, Dash\_);
		$this->assertSame('1, 2, 3, 4, 5, 6', $partial(1, 2, 4, 6));

		// With only placeholders
		$partial = Dash\partialRight($callable, Dash\_, Dash\_, Dash\_, Dash\_);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2, 3, 4));
	}

	public function testExamples()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};

		$greetMark = Dash\partialRight($greet, 'Mark');
		$greetJane = Dash\partialRight($greet, 'Jane');

		$this->assertSame('Hello, Mark!', $greetMark('Hello'));
		$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));

		$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
		$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

		$this->assertSame('Hello, Mark!', $sayHello('Mark'));
		$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));
	}
}
