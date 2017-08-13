<?php

use Dash\_;

class thruTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForThru
	 */
	public function testStandaloneThru($collection, $interceptor, $expected)
	{
		$actual = Dash\thru($collection, $interceptor);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForThru
	 */
	public function testChainedThru($collection, $interceptor, $expected)
	{
		$actual = _::chain($collection)->thru($interceptor)->value();
		$this->assertSame($expected, $actual);
	}

	public function casesForThru()
	{
		return array(
			'should return the modified collection when the interceptor returns a modifed collection' => array(
				array('a' => 1, 'b' => 2),
				function($collection) {
					$collection['c'] = 3;
					return $collection;
				},
				array('a' => 1, 'b' => 2, 'c' => 3)
			),
			'should return the new collection when the interceptor returns a new collection' => array(
				array('a' => 1, 'b' => 2),
				function() {
					return array(2, 3, 5);
				},
				array(2, 3, 5)
			),
		);
	}
}
