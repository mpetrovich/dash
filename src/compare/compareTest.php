<?php

/**
 * @covers Dash\compare
 * @covers Dash\_compare
 */
class compareTest extends PHPUnit_Framework_TestCase
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
		$compare = Dash\_compare($b);
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
}
