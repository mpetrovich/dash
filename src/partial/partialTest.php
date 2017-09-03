<?php

/**
 * @covers Dash\partial
 */
class partialTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$concat = function (/* ...elements */) {
			return implode(', ', func_get_args());
		};

		// With no fixed args
		$partial = Dash\partial($concat);
		$this->assertSame('1, 2, 3', $partial(1, 2, 3));

		// With some fixed args
		$partial = Dash\partial($concat, 1, 2);
		$this->assertSame('1, 2, 3, 4', $partial(3, 4));

		// With only fixed args
		$partial = Dash\partial($concat, 3, 4, 5);
		$this->assertSame('3, 4, 5', $partial());
	}

	public function testPlaceholders()
	{
		$concat = function (/* ...elements */) {
			return implode(', ', func_get_args());
		};

		$partial = Dash\partial($concat, 1, Dash\_, 3, 4, Dash\_);
		$this->assertSame('1, 2, 3, 4, 5, 6, 7', $partial(2, 5, 6, 7));
	}

	public function testExample()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};
		$sayHello = Dash\partial($greet, 'Hello');
		$sayHowdy = Dash\partial($greet, 'Howdy');

		$this->assertSame('Hello, Mark!', $sayHello('Mark'));
		$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));
	}

	public function testPlaceholderExample()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};
		$greetMark = Dash\partial($greet, Dash\_, 'Mark');
		$greetJane = Dash\partial($greet, Dash\_, 'Jane');

		$this->assertSame('Hello, Mark!', $greetMark('Hello'));
		$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));
	}
}
