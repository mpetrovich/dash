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

		$first = Dash\curryN($callable, 2);
		$second = $first();  // No-op
		$third = $second(1);
		$fourth = $third();  // No-op
		$fifth = $fourth(2);
		$this->assertSame('1, 2, 3', $fifth);

		$first = Dash\curryN($callable, 2);
		$second = $first(1);
		$third = $second(2);
		$this->assertSame('1, 2, 3', $third);

		$first = Dash\curryN($callable, 2);
		$second = $first(1, 2);
		$this->assertSame('1, 2, 3', $second);

		$first = Dash\curryN($callable, 2, 1, 2);
		$this->assertSame('1, 2, 3', $first);

		$first = Dash\curryN($callable, 2, 1, 2, 4);
		$this->assertSame('1, 2, 3', $first);
	}
}
