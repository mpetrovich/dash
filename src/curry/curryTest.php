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

		$first = Dash\curry($callable);
		$second = $first(1);
		$third = $second(2);
		$fourth = $third(3);
		$this->assertSame('1, 2, 3', $fourth);

		$first = Dash\curry($callable);
		$second = $first(1);
		$third = $second();  // No-op
		$fourth = $third(2);
		$fifth = $fourth();  // No-op
		$sixth = $fifth(3);
		$this->assertSame('1, 2, 3', $sixth);

		$first = Dash\curry($callable);
		$second = $first(1, 2);
		$third = $second(3);
		$this->assertSame('1, 2, 3', $third);

		$first = Dash\curry($callable);
		$second = $first(1);
		$third = $second(2, 3);
		$this->assertSame('1, 2, 3', $third);

		$first = Dash\curry($callable);
		$second = $first(1, 2, 3);
		$this->assertSame('1, 2, 3', $second);

		$first = Dash\curry($callable, 1);
		$second = $first(2, 3);
		$this->assertSame('1, 2, 3', $second);

		$first = Dash\curry($callable, 1);
		$second = $first(2);
		$third = $second(3);
		$this->assertSame('1, 2, 3', $third);

		$first = Dash\curry($callable, 1, 2);
		$second = $first(3);
		$this->assertSame('1, 2, 3', $second);

		$first = Dash\curry($callable, 1, 2, 3);
		$this->assertSame('1, 2, 3', $first);
	}
}
