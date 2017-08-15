<?php

class thruTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $interceptor, $expected)
	{
		$actual = Dash\thru($collection, $interceptor);
		$this->assertSame($expected, $actual);
	}

	public function cases()
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
