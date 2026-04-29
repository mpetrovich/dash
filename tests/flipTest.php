<?php

/**
 * @covers Dash\flip
 */
class flipTest extends PHPUnit\Framework\TestCase
{
	public function testSwapsFirstTwoArgs()
	{
		$join = function ($a, $b, $c = '') {
			return implode(':', [$a, $b, $c]);
		};

		$flipped = Dash\flip($join);
		$this->assertSame('b:a:c', $flipped('a', 'b', 'c'));
	}

	public function testWithSingleArg()
	{
		$identity = function ($a) {
			return $a;
		};

		$flipped = Dash\flip($identity);
		$this->assertSame('a', $flipped('a'));
	}

	public function testWithNoArgs()
	{
		$const = function () {
			return 42;
		};

		$flipped = Dash\flip($const);
		$this->assertSame(42, $flipped());
	}
}
