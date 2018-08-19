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
		$result = $curried(3);
		$this->assertSame('1, 2, 3', $result);

		// With no-op calls
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried();  // No-op
		$curried = $curried(2);
		$curried = $curried();  // No-op
		$result = $curried(3);
		$this->assertSame('1, 2, 3', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1, 2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3', $result);

		// With a mix of single & multiple arguments
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3', $result);

		// With multiple arguments
		$curried = Dash\curry($callable);
		$result = $curried(1, 2, 3);
		$this->assertSame('1, 2, 3', $result);

		// With one initial argument
		$curried = Dash\curry($callable, 1);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3', $result);

		// With one initial argument
		$curried = Dash\curry($callable, 1);
		$curried = $curried(2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3', $result);

		// With several initial arguments
		$curried = Dash\curry($callable, 1, 2);
		$result = $curried(3);
		$this->assertSame('1, 2, 3', $result);

		// With all initial arguments
		$result = Dash\curry($callable, 1, 2, 3);
		$this->assertSame('1, 2, 3', $result);
	}

	/**
	 * @dataProvider casesCallableTypes
	 */
	public function testCallableTypes($callable)
	{
		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$this->assertSame(3, $curried(2));
	}

	public function instanceMethod($a, $b)
	{
		return $a + $b;
	}

	public static function staticMethod($a, $b)
	{
		return $a + $b;
	}

	public function casesCallableTypes()
	{
		// All valid callables listed here: http://php.net/manual/en/language.types.callable.php
		// except for relative static methods
		return [
			'With anonymous closure' => [
				'callable' => function ($a, $b) {
					return $a + $b;
				},
			],
			'With global function' => [
				'callable' => 'curryTest_globalFunction',
			],
			'With static class method' => [
				'callable' => 'curryTest::staticMethod',
			],
			'With static class method as array' => [
				'callable' => ['curryTest', 'staticMethod'],
			],
			'With instance class method' => [
				'callable' => [$this, 'instanceMethod'],
			],
			'With a class that implements __invoke()' => [
				'callable' => new curryTest_classC(),
			],
		];
	}

	public function testPlaceholders()
	{
		$callable = function ($a, $b, $c, $d) {
			return implode(', ', [$a, $b, $c, $d]);
		};

		/*
			One placeholder
		 */

		$curried = Dash\curry($callable, Dash\_, 2);
		$curried = $curried(1);
		$result = $curried(3, 4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(1);
		$result = $curried(3, 4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(1, 3);
		$result = $curried(4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried(Dash\_, 3, 4);
		$result = $curried(2);
		$this->assertSame('1, 2, 3, 4', $result);

		/*
			Two placeholders
		 */

		$curried = Dash\curry($callable, Dash\_, Dash\_, 3);
		$curried = $curried(1);
		$result = $curried(2, 4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(Dash\_, Dash\_, 3);
		$curried = $curried(1);
		$result = $curried(2, 4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(Dash\_, Dash\_, 3);
		$result = $curried(1, 2, 4);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(1);
		$curried = $curried(Dash\_, Dash\_, 4);
		$result = $curried(2, 3);
		$this->assertSame('1, 2, 3, 4', $result);

		$curried = Dash\curry($callable);
		$curried = $curried(Dash\_, 2);
		$curried = $curried(Dash\_, 3);
		$result = $curried(1, 4);
		$this->assertSame('1, 2, 3, 4', $result);
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

		$greetMary = Dash\curry($greet, Dash\_, 'Ms.', 'Mary');
		$this->assertSame('Good morning, Ms. Mary', $greetMary('Good morning'));

		$greetSir = Dash\curry($greet, Dash\_, 'Sir');
		$goodMorningSir = $greetSir('Good morning');
		$this->assertSame('Good morning, Sir Peter', $goodMorningSir('Peter'));
	}
}

/**
 * @codingStandardsIgnoreStart
 */
function curryTest_globalFunction($a, $b)
{
	return $a + $b;
}

class curryTest_classA
{
	public static function sum($a, $b)
	{
		return $a + $b;
	}
}

class curryTest_classB extends curryTest_classA
{
	public static function sum($a, $b)
	{
		return 0;
	}
}

class curryTest_classC
{
	public function __invoke($a, $b)
	{
		return $a + $b;
	}
}
