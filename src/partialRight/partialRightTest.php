<?php

/**
 * @covers Dash\partialRight
 */
class partialRightTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForPartialRight
	 */
	public function testStandalonePartialRight($partialRightArgs, $invokeArgs, $expected)
	{
		$partialRight = call_user_func_array('Dash\partialRight', $partialRightArgs);
		$actual = call_user_func_array($partialRight, $invokeArgs);
		$this->assertSame($expected, $actual);
	}

	public function casesForPartialRight()
	{
		$sum = function ($a, $b, $c) {
			return $a + $b + $c;
		};

		return [
			'With all function parameters pre-specified' => [
				[$sum, 1, 2, 3],
				[],
				6
			],
			'With some function parameters pre-specified' => [
				[$sum, 2, 3],
				[1],
				6
			],
			'With no function parameters pre-specified' => [
				[$sum],
				[1, 2, 3],
				6
			],
		];
	}
}
