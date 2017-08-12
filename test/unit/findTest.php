<?php

use Dash\_;

class findTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForFind
	 */
	public function testStandaloneFind($collection, $predicate, $expected)
	{
		$actual = Dash\find($collection, $predicate);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForFind
	 */
	public function testChainedFind($collection, $predicate, $expected)
	{
		$_ = new _($collection);
		$actual = $_->find($predicate)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForFind()
	{
		return array(
			'With an empty array' => array(
				array(),
				function() { return false; },
				null
			),
			'With a non-matching search of an array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				),
				function() { return false; },
				null
			),
			'With a matching value search of an array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				),
				function($value) {
					return $value == 'second';
				},
				array('b', 'second')
			),
			'With a matching key search of an array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				),
				function($value, $key) {
					return $key == 'd';
				},
				array('d', 'second')
			),
		);
	}
}
