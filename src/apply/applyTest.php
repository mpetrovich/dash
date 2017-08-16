<?php

/**
 * @covers Dash\apply
 */
class applyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $expected)
	{
		$func = function () use ($args) {
			$this->assertEquals($args, func_get_args());
			return Dash\sum(func_get_args());
		};

		$this->assertEquals($expected, Dash\apply($func, $args));
	}

	public function cases()
	{
		return [
			'With no args' => [
				'args' => [],
				'expected' => 0,
			],
			'With one arg' => [
				'args' => [3],
				'expected' => 3,
			],
			'With multiple args' => [
				'args' => [1, 2, 3, 4],
				'expected' => 10,
			],
		];
	}
}
