<?php

/**
 * @covers Dash\ary
 */
class aryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $ary, $expectedArgs)
	{
		$func = function () use ($expectedArgs) {
			$this->assertEquals($expectedArgs, func_get_args());
		};
		$funcAried = Dash\ary($func, $ary);
		call_user_func_array($funcAried, $args);
	}

	public function cases()
	{
		return [
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 5,
				'expectedArgs' => ['a', 1, 'b', 2],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 4,
				'expectedArgs' => ['a', 1, 'b', 2],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 3,
				'expectedArgs' => ['a', 1, 'b'],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 2,
				'expectedArgs' => ['a', 1],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 1,
				'expectedArgs' => ['a'],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => 0,
				'expectedArgs' => [],
			],
			[
				'args' => ['a', 1, 'b', 2],
				'ary' => -1,
				'expectedArgs' => [],
			],
		];
	}
}
