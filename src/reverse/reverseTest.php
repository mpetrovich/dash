<?php

/**
 * @covers Dash\reverse
 */
class reverseTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\reverse($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				[]
			),
			'With an indexed array' => array(
				array(0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e'),
				array(4 => 'e', 3 => 'd', 2 => 'c', 1 => 'b', 0 => 'a')
			),
			'With an associative array' => array(
				array('1st' => 'a', '2nd' => 'b', '3rd' => 'c', '4th' => 'd', '5th' => 'e'),
				array('5th' => 'e', '4th' => 'd', '3rd' => 'c', '2nd' => 'b', '1st' => 'a')
			),
		);
	}
}
