<?php

/**
 * @covers Dash\first
 */
class firstTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$actual = Dash\first($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				null
			],
			'With an array' => [
				['a', 'b', 'c'],
				'a'
			],
			'With an array with null as the first element' => [
				[null, 'b', 'c'],
				null
			],
		];
	}
}
