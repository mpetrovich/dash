<?php

/**
 * @covers Dash\currify
 */
class currifyTest extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$callable = function ($array, $date, $number, $string) {
			return $date->format('Y-m-d') . ' ' . $number . ': ' . implode($string, $array);
		};
		$curried = Dash\currify($callable);

		$result = $curried(
			new DateTime('2017-01-01'),
			123,
			'-',
			[1, 2, 3]
		);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);

		$first = $curried();  // No-op
		$second = $first(new DateTime('2017-01-01'), 123);
		$third = $second();  // No-op
		$fourth = $third('-');
		$fifth = $fourth();  // No-op
		$sixth = $fifth([1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $sixth);
	}

	public function testWithArgs()
	{
		$callable = function ($array, $date, $number, $string) {
			return $date->format('Y-m-d') . ' ' . $number . ': ' . implode($string, $array);
		};
		$curried = Dash\currify($callable, [new DateTime('2017-01-01'), 123]);

		$result = $curried('-', [1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $result);

		$first = $curried('-');
		$second = $first();  // No-op
		$third = $second([1, 2, 3]);
		$this->assertSame('2017-01-01 123: 1-2-3', $third);
	}

	public function testWithRotate()
	{
		$this->markTestIncomplete();
	}
}
