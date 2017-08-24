<?php

/**
 * @covers Dash\join
 */
class joinTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $separator, $expected)
	{
		$this->assertEquals($expected, Dash\join($input, $separator));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3],
				'separator' => ', ',
				'expected' => '1, 2, 3',
			],
			[
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'separator' => ', ',
				'expected' => '1, 2, 3',
			],
			[
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'separator' => ', ',
				'expected' => '1, 2, 3',
			],
		];
	}
}
