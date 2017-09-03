<?php

/**
 * @covers Dash\partialRight
 */
class partialRightTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$concat = function (/* ...elements */) {
			return implode(', ', func_get_args());
		};

		// With no fixed args
		$partial = Dash\partialRight($concat);
		$this->assertSame('1, 2, 3', $partial(1, 2, 3));

		// With some fixed args
		$partial = Dash\partialRight($concat, 3, 4);
		$this->assertSame('1, 2, 3, 4', $partial(1, 2));

		// With only fixed args
		$partial = Dash\partialRight($concat, 3, 4, 5);
		$this->assertSame('3, 4, 5', $partial());
	}

	public function testPlaceholders()
	{
		$concat = function (/* ...elements */) {
			return implode(', ', func_get_args());
		};

		$partial = Dash\partialRight($concat, 3, Dash\_, 5, 6, Dash\_);
		$this->assertSame('1, 2, 3, 4, 5, 6, 7', $partial(1, 2, 4, 7));
	}

	public function testExample()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};
		$greetMark = Dash\partialRight($greet, 'Mark');
		$greetJane = Dash\partialRight($greet, 'Jane');

		$this->assertSame('Hello, Mark!', $greetMark('Hello'));
		$this->assertSame('Howdy, Jane!', $greetJane('Howdy'));
	}

	public function testPlaceholderExample()
	{
		$greet = function ($greeting, $name) {
			return "$greeting, $name!";
		};
		$sayHello = Dash\partialRight($greet, 'Hello', Dash\_);
		$sayHowdy = Dash\partialRight($greet, 'Howdy', Dash\_);

		$this->assertSame('Hello, Mark!', $sayHello('Mark'));
		$this->assertSame('Howdy, Jane!', $sayHowdy('Jane'));
	}
}
