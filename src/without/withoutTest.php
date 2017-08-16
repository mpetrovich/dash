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
		return array(
			'With an empty array' => array(
				[],
				[],
				[]
			),
			'With no matching exclusions' => array(
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'),
				array(1 => 'e', 2 => 'f'),
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd')
			),
			'With matching exclusions' => array(
				array(1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'),
				array(1 => 'c', 2 => 'b'),
				array(1 => 'a', 4 => 'd')
			),
		);
	}
}
