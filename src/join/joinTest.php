<?php

class joinTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $glue, $expected)
	{
		$this->assertEquals($expected, Dash\join($input, $glue));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3],
				'glue' => ', ',
				'expected' => '1, 2, 3',
			],
			[
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'glue' => ', ',
				'expected' => '1, 2, 3',
			],
		];
	}
}
