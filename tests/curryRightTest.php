<?php

/**
 * @covers Dash\curryRight
 */
class curryRightTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$callable = function ($a, $b, $c) {
			return implode(', ', [$a, $b, $c]);
		};

		// With single arguments
		$curried = Dash\curryRight($callable);
		$curried = $curried(3);
		$curried = $curried(2);
		$result = $curried(1);
		$this->assertSame('1, 2, 3', $result);

		// With no-op calls
		$curried = Dash\curryRight($callable);
		$curried = $curried(3);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$curried = $curried();  // No-op
		$result = $curried(1);
		$this->assertSame('1, 2, 3', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryRight($callable);
		$curried = $curried(2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryRight($callable);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3', $result);

		// With multiple arguments
		$curried = Dash\curryRight($callable);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3', $result);

		// With one initial argument
		$curried = Dash\curryRight($callable, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3', $result);

		// With one initial argument
		$curried = Dash\curryRight($callable, 3);
		$curried = $curried(2);
		$result = $curried(1);
		$this->assertSame('1, 2, 3', $result);

		// With several initial arguments
		$curried = Dash\curryRight($callable, 2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3', $result);

		// With all initial arguments
		$result = Dash\curryRight($callable, 1, 2, 3);
		$this->assertSame('1, 2, 3', $result);

		// With too many initial arguments
		$result = Dash\curryRight($callable, 1, 2, 3, 4);
		$this->assertSame('1, 2, 3', $result);
	}

	public function testPlaceholders()
	{
		$callable = function ($a, $b, $c, $d) {
			return implode(', ', [$a, $b, $c, $d]);
		};

		/*
			One placeholder
		 */

		$curried = Dash\curryRight($callable, 3, Dash\_);
		$curried = $curried(4);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(4);
		$curried = $curried(Dash\_, 2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		/*
			Two placeholders
		 */

		$curried = Dash\curryRight($callable, 2, Dash\_, Dash\_);
		$curried = $curried(4);
		$result = $curried(1, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(Dash\_, Dash\_, 4);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(Dash\_, Dash\_, 4);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(4);
		$curried = $curried(Dash\_, Dash\_, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curryRight($callable);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(Dash\_, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);
	}

	public function testExamples()
	{
		$greet = function ($greeting, $salutation, $name) {
			return "$greeting, $salutation $name";
		};

		$greetMary = Dash\curryRight($greet, 'Mary');
		$greetMsMary = $greetMary('Ms.');
		$this->assertSame('Good morning, Ms. Mary', $greetMsMary('Good morning'));

		$greetPeter = Dash\curryRight($greet, 'Peter');
		$greetSirPeter = $greetPeter('Sir');
		$this->assertSame('Good morning, Sir Peter', $greetSirPeter('Good morning'));

		$goodMorning = Dash\curryRight($greet, 'Good morning', Dash\_, Dash\_);
		$goodMorningSir = $goodMorning('Sir', Dash\_);
		$this->assertSame('Good morning, Sir Peter', $goodMorningSir('Peter'));

		$greetMs = Dash\curryRight($greet, 'Ms.', Dash\_);
		$goodMorningMs = $greetMs('Good morning', Dash\_);
		$this->assertSame('Good morning, Ms. Mary', $goodMorningMs('Mary'));
	}
}
