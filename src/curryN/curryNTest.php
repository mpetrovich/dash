<?php

/**
 * @covers Dash\curryN
 */
class curryNTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function ($a, $b, $c = 3) {
			return implode(', ', [$a, $b, $c]);
		};

		// With single arguments
		$curried = Dash\curryN($callable, 2);
		$curried = $curried(1);
		$curried = $curried(2);
		$this->assertSame('1, 2, 3', $curried);

		// With no-op calls
		$curried = Dash\curryN($callable, 2);
		$curried = $curried();  // No-op
		$curried = $curried(1);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$this->assertSame('1, 2, 3', $curried);

		// With one initial argument
		$curried = Dash\curryN($callable, 2);
		$curried = $curried(1, 2);
		$this->assertSame('1, 2, 3', $curried);

		// With all initial arguments
		$curried = Dash\curryN($callable, 2, 1, 2);
		$this->assertSame('1, 2, 3', $curried);

		// With more than all initial arguments
		$curried = Dash\curryN($callable, 2, 1, 2, 4);
		$this->assertSame('1, 2, 3', $curried);
	}

	public function testExamples()
	{
		$greet = function ($greeting, $name, $salutation = 'Mr.') {
			return "$greeting, $salutation $name";
		};

		$goodMorningMr = Dash\curryN($greet, 2, 'Good morning');
		$this->assertSame('Good morning, Mr. Smith', $goodMorningMr('Smith'));
	}
}
