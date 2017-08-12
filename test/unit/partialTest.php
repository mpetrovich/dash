<?php

use Dash\_;

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
		$sum = function($a, $b, $c) {
			return $a + $b + $c;
		};

		return array(
			'With all function parameters pre-specified' => array(
				array($sum, 1, 2, 3),
				array(),
				6
			),
			'With some function parameters pre-specified' => array(
				array($sum, 1, 2),
				array(3),
				6
			),
			'With no function parameters pre-specified' => array(
				array($sum),
				array(1, 2, 3),
				6
			),
		);
	}
}
