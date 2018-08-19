<?php

/**
 * @covers Dash\curryRightN
 */
class curryRightNTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function ($a, $b, $c, $d = 4) {
			return implode(', ', [$a, $b, $c, $d]);
		};

		// With single arguments
		$curried = Dash\curryRightN($callable, 3);
		$curried = $curried(3);
		$curried = $curried(2);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		// With no-op calls
		$curried = Dash\curryRightN($callable, 3);
		$curried = $curried(3);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$curried = $curried();  // No-op
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryRightN($callable, 3);
		$curried = $curried(2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryRightN($callable, 3);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		// With multiple arguments
		$curried = Dash\curryRightN($callable, 3);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With one initial argument
		$curried = Dash\curryRightN($callable, 3, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4', $result);

		// With one initial argument
		$curried = Dash\curryRightN($callable, 3, 3);
		$curried = $curried(2);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		// With several initial arguments
		$curried = Dash\curryRightN($callable, 3, 2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4', $result);

		// With all initial arguments
		$result = Dash\curryRightN($callable, 3, 1, 2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With too many initial arguments
		$result = Dash\curryRightN($callable, 3, 1, 2, 3, 4);
		$this->assertSame('1, 2, 3, 4', $result);
	}

	public function testPlaceholders()
	{
		$callable = function ($a, $b, $c, $d, $e = 5) {
			return implode(', ', [$a, $b, $c, $d, $e]);
		};

		/*
			One placeholder
		 */

		$curried = Dash\curryRightN($callable, 4, 3, Dash\_);
		$curried = $curried(4);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(4);
		$curried = $curried(Dash\_, 2, 3);
		$result = $curried(1);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		/*
			Two placeholders
		 */

		$curried = Dash\curryRightN($callable, 4, 2, Dash\_, Dash\_);
		$curried = $curried(4);
		$result = $curried(1, 3);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(Dash\_, Dash\_, 4);
		$curried = $curried(3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(Dash\_, Dash\_, 4);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(4);
		$curried = $curried(Dash\_, Dash\_, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryRightN($callable, 4);
		$curried = $curried(Dash\_, 4);
		$curried = $curried(Dash\_, 3);
		$result = $curried(1, 2);
		$this->assertSame('1, 2, 3, 4, 5', $result);
	}

	public function testExamples()
	{
		$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
			return "$greeting, $salutation $name$punctuation";
		};

		$greetMary = Dash\curryRightN($greet, 3, 'Mary');
		$greetMsMary = $greetMary('Ms.');
		$this->assertSame('Good morning, Ms. Mary!', $greetMsMary('Good morning'));

		$greetPeter = Dash\curryRightN($greet, 3, 'Peter');
		$greetSirPeter = $greetPeter('Sir');
		$this->assertSame('Good morning, Sir Peter!', $greetSirPeter('Good morning'));

		$goodMorning = Dash\curryRightN($greet, 3, 'Good morning', Dash\_, Dash\_);
		$goodMorningSir = $goodMorning('Sir', Dash\_);
		$this->assertSame('Good morning, Sir Peter!', $goodMorningSir('Peter'));

		$greetMs = Dash\curryRightN($greet, 3, 'Ms.', Dash\_);
		$goodMorningMs = $greetMs('Good morning', Dash\_);
		$this->assertSame('Good morning, Ms. Mary!', $goodMorningMs('Mary'));
	}
}
