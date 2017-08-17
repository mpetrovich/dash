<?php

/**
 * @covers Dash\without
 */
class withoutTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $without, $expected)
	{
		$actual = Dash\without($iterable, $without);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				[],
				[]
			],
			'With no matching exclusions' => [
				[1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'],
				[1 => 'e', 2 => 'f'],
				[1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd']
			],
			'With matching exclusions' => [
				[1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'],
				[1 => 'c', 2 => 'b'],
				[1 => 'a', 4 => 'd']
			],
		];
	}
}
