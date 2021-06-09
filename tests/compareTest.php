<?php

/**
 * @covers Dash\compare
 * @covers Dash\Curry\compare
 */
class compareTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$this->assertSame($expected, Dash\compare($a, $b));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($a, $b, $expected)
	{
		$compare = Dash\Curry\compare($b);
		$this->assertSame($expected, $compare($a));
	}

	public function cases()
	{
		return [
			'$a === $b' => [3, 3, 0],
			'$a == $b' => ['3', 3, 0],
			'$a > $b' => [4, 3, +1],
			'$a < $b' => [2, 3, -1],
		];
	}

	public function testExamples()
	{
		$this->assertLessThan(0, Dash\compare(2, 3));
		$this->assertGreaterThan(0, Dash\compare(2, 1));
		$this->assertSame(0, Dash\compare(2, 2));
	}
}
