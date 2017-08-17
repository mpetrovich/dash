<?php

/**
 * @covers Dash\identical
 */
class identicalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$actual = Dash\identical($a, $b);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With two identical arrays' => array(
				[1, 2, 3],
				[1, 2, 3],
				true
			),
			'With two non-identical arrays' => array(
				[1, 2, 3],
				[1, '2', 3],
				false
			),
			'With two identical objects' => array(
				[0 => 'a', 1 => 'b', 2 => 'c'],
				[0 => 'a', 1 => 'b', 2 => 'c'],
				true
			),
			'With two non-identical objects' => array(
				[0 => 'a', 1 => 'b', 2 => 'c'],
				[0 => 'a', 1 => 'x', 2 => 'c'],
				false
			),
			'With two identical strings' => [
				'abc',
				'abc',
				true
			],
			'With two non-identical strings' => [
				'abc',
				'def',
				false
			],
			'With two identical numbers' => [
				123,
				123,
				true
			],
			'With two non-identical numbers' => [
				123,
				321,
				false
			],
			'With two identical booleans' => [
				true,
				true,
				true
			],
			'With two non-identical booleans' => [
				true,
				false,
				false
			],
			'With two equal but non-identical values' => [
				123,
				'123',
				false
			],
			'With two equal but non-identical values' => [
				false,
				'',
				false
			],
		);
	}
}
