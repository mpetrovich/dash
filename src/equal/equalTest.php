<?php

/**
 * @covers Dash\equal
 * @covers Dash\_equal
 */
class equalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$this->assertSame($expected, Dash\equal($a, $b));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($a, $b, $expected)
	{
		$equal = Dash\_equal($a);
		$this->assertSame($expected, $equal($b));
	}

	public function cases()
	{
		return [
			'With identical values' => [
				3,
				3,
				true
			],
			'With equal but not identical values' => [
				'3',
				3,
				true
			],
			'With inequal values of the same type' => [
				4,
				3,
				false
			],
			'With inequal values of different types' => [
				'4',
				3,
				false
			],
			'With two identical arrays' => [
				[1, 2, 3],
				[1, 2, 3],
				true
			],
			'With two non-identical arrays' => [
				[1, 2, 3],
				[1, '2', 3],
				true
			],
			'With two non-identical numbers' => [
				123,
				123.0,
				true
			],
		];
	}
}
