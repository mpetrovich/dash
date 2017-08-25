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
		return [
			'With an empty array' => [
				[],
				[]
			],
			'With an indexed array' => [
				['a', 'b', 'c', 'd', 'e'],
				['e', 'd', 'c', 'b', 'a']
			],
			'With an associative array' => [
				['a' => 'one', 'b' => 'two', 'c' => 'three'],
				['c' => 'three', 'b' => 'two', 'a' => 'one'],
			],
		];
	}
}
