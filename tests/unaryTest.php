<?php

/**
 * @covers Dash\unary
 * @covers Dash\Curry\unary
 */
class unaryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $expected)
	{
		$func = function () {
			return func_get_args();
		};

		$unary = Dash\unary($func);
		$this->assertSame($expected, call_user_func_array($unary, $args));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($args, $expected)
	{
		$func = function () {
			return func_get_args();
		};

		$unary = Dash\Curry\unary();
		$this->assertSame($expected, call_user_func_array($unary($func), $args));
	}

	public function cases()
	{
		return [
			'With no args' => [
				'args' => [],
				'expected' => [],
			],
			'With args' => [
				'args' => ['a', 'b', 'c', 'd'],
				'expected' => ['a'],
			],
		];
	}

	public function testExamples()
	{
		$isNumeric = Dash\unary('is_numeric');
		$this->assertSame([1, 2.0, '3'], Dash\filter([1, 2.0, '3', 'a'], $isNumeric));
	}
}
