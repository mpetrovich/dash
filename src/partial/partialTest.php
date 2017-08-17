<?php

/**
 * @covers Dash\partial
 */
class partialTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForPartial
	 */
	public function testStandalonePartial($partialArgs, $invokeArgs, $expected)
	{
		$partial = call_user_func_array('Dash\partial', $partialArgs);
		$actual = call_user_func_array($partial, $invokeArgs);
		$this->assertSame($expected, $actual);
	}

	public function casesForPartial()
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
				[$sum, 1, 2],
				[3],
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
