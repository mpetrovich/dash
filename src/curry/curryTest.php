<?php

/**
 * @covers Dash\curry
 */
class curryTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function ($a, $b, $c) {
			return implode(', ', [$a, $b, $c]);
		};

		// With single arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried(2);
		$curried = $curried(3);
		$this->assertSame('1, 2, 3', $curried);

		// With no-op calls
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$curried = $curried();  // No-op
		$curried = $curried(3);
		$this->assertSame('1, 2, 3', $curried);

		// With a mix of single & multiple arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1, 2);
		$curried = $curried(3);
		$this->assertSame('1, 2, 3', $curried);

		// With a mix of single & multiple arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried(2, 3);
		$this->assertSame('1, 2, 3', $curried);

		// With multiple arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3', $curried);

		// With one initial argument
		$curried = Dash\curry($callable, 1);
		$curried = $curried(2, 3);
		$this->assertSame('1, 2, 3', $curried);

		// With one initial argument
		$curried = Dash\curry($callable, 1);
		$curried = $curried(2);
		$curried = $curried(3);
		$this->assertSame('1, 2, 3', $curried);

		// With several initial arguments
		$curried = Dash\curry($callable, 1, 2);
		$curried = $curried(3);
		$this->assertSame('1, 2, 3', $curried);

		// With all initial arguments
		$curried = Dash\curry($callable, 1, 2, 3);
		$this->assertSame('1, 2, 3', $curried);
	}

	public function testExamples()
	{
		$greet = function ($greeting, $salutation, $name) {
			return "$greeting, $salutation $name";
		};

		$goodMorning = Dash\curry($greet, 'Good morning');
		$this->assertSame('Good morning, Ms. Mary', $goodMorning('Ms.', 'Mary'));

		$goodMorning = Dash\curry($greet, 'Good morning');
		$goodMorningSir = $goodMorning('Sir');
		$this->assertSame('Good morning, Sir Peter', $goodMorningSir('Peter'));
	}
}
