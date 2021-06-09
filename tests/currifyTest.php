<?php

/**
 * @covers Dash\currify
 */
class currifyTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$callable = function ($array, $date, $number, $string) {
			return $date->format('Y-m-d') . ' ' . $number . ': ' . implode($string, $array);
		};

		// With single arguments
		$curried = Dash\currify($callable);
		$curried = $curried();  // No-op
		$curried = $curried(new DateTime('2017-01-01'), 123);
		$curried = $curried();  // No-op
		$curried = $curried('-');
		$curried = $curried();  // No-op
		$result = $curried([1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);

		// With multiple initial arguments
		$curried = Dash\currify($callable);
		$result = $curried(
			new DateTime('2017-01-01'),
			123,
			'-',
			[1, 2, 3]
		);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);
	}

	public function testWithArgs()
	{
		$callable = function ($array, $date, $number, $string) {
			return $date->format('Y-m-d') . ' ' . $number . ': ' . implode($string, $array);
		};

		$curried = Dash\currify($callable, [new DateTime('2017-01-01'), 123]);
		$result = $curried('-', [1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);

		$curried = Dash\currify($callable, [new DateTime('2017-01-01'), 123]);
		$curried = $curried('-');
		$curried = $curried();  // No-op
		$result = $curried([1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);
	}

	public function testWithRotate()
	{
		$callable = function ($array, $date, $number, $string) {
			return $date->format('Y-m-d') . ' ' . $number . ': ' . implode($string, $array);
		};

		$curried = Dash\currify($callable, [123, '-'], 2);
		$result = $curried([1, 2, 3], new DateTime('2017-01-01'));
		$this->assertSame('2017-01-01 123: 1-2-3', $result);

		$curried = Dash\currify($callable, [123, '-'], 2);
		$curried = $curried([1, 2, 3]);
		$curried = $curried();  // No-op
		$result = $curried(new DateTime('2017-01-01'));
		$this->assertSame('2017-01-01 123: 1-2-3', $result);
	}

	public function testExamples()
	{
		$greet = function ($name, $greeting, $punctuation) {
			return "$greeting, $name$punctuation";
		};

		$goodMorning = Dash\currify($greet, ['Good morning', '!']);
		$this->assertSame('Good morning, John!', $goodMorning('John'));

		$greet = function ($salutation, $name, $greeting, $punctuation) {
			return "$greeting, $salutation $name$punctuation";
		};

		$goodMorning = Dash\currify($greet, ['Good morning', '!'], 2);
		$this->assertSame('Good morning, Sir John!', $goodMorning('Sir', 'John'));
	}
}
