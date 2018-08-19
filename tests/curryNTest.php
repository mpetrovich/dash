<?php

/**
 * @covers Dash\curryN
 */
class curryNTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function ($a, $b, $c, $d = 4) {
			return implode(', ', [$a, $b, $c, $d]);
		};

		// With single arguments
		$curried = Dash\curryN($callable, 3);
		$curried = $curried(1);
		$curried = $curried(2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With no-op calls
		$curried = Dash\curryN($callable, 3);
		$curried = $curried(1);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$curried = $curried();  // No-op
		$result = $curried(3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryN($callable, 3);
		$curried = $curried(1, 2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curryN($callable, 3);
		$curried = $curried(1);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With multiple arguments
		$curried = Dash\curryN($callable, 3);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With one initial argument
		$curried = Dash\curryN($callable, 3, 1);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With one initial argument
		$curried = Dash\curryN($callable, 3, 1);
		$curried = $curried(2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With several initial arguments
		$curried = Dash\curryN($callable, 3, 1, 2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With all initial arguments
		$result = Dash\curryN($callable, 3, 1, 2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		// With too many initial arguments
		$result = Dash\curryN($callable, 3, 1, 2, 3, 5);
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

		$curried = Dash\curryN($callable, 4, Dash\_, 2);
		$curried = $curried(1);
		$result = $curried(3, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(1);
		$result = $curried(3, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(1, 3);
		$result = $curried(4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(1);
		$curried = $curried(Dash\_, 3, 4);
		$result = $curried(2);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		/*
			Two placeholders
		 */

		$curried = Dash\curryN($callable, 4, Dash\_, Dash\_, 3);
		$curried = $curried(1);
		$result = $curried(2, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(Dash\_, Dash\_, 3);
		$curried = $curried(1);
		$result = $curried(2, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(Dash\_, Dash\_, 3);
		$result = $curried(1, 2, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(1);
		$curried = $curried(Dash\_, Dash\_, 4);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3, 4, 5', $result);

		$curried = Dash\curryN($callable, 4);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(Dash\_, 3);
		$result = $curried(1, 4);
		$this->assertSame('1, 2, 3, 4, 5', $result);
	}

	public function testExamples()
	{
		$greet = function ($greeting, $salutation, $name, $punctuation = '!') {
			return "$greeting, $salutation $name$punctuation";
		};

		$goodMorning = Dash\curryN($greet, 3, 'Good morning');
		$this->assertSame('Good morning, Ms. Mary!', $goodMorning('Ms.', 'Mary'));

		$goodMorning = Dash\curryN($greet, 3, 'Good morning');
		$goodMorningSir = $goodMorning('Sir');
		$this->assertSame('Good morning, Sir Peter!', $goodMorningSir('Peter'));

		$greetSir = Dash\curryN($greet, 3, Dash\_, 'Sir');
		$goodMorningSir = $greetSir('Good morning');
		$this->assertSame('Good morning, Sir Peter!', $goodMorningSir('Peter'));

		$greetMary = Dash\curryN($greet, 3, Dash\_, Dash\_, 'Mary');
		$greetMsMary = $greetMary(Dash\_, 'Ms.');
		$this->assertSame('Good morning, Ms. Mary!', $greetMsMary('Good morning'));
	}
}
