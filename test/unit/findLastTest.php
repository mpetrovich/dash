<?php

use Dash\_;

class findLastTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForFindLast
	 */
	public function testStandaloneFindLast($collection, $predicate, $expected)
	{
		$actual = Dash\findLast($collection, $predicate);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForFindLast
	 */
	public function testChainedFindLast($collection, $predicate, $expected)
	{
		$_ = new _($collection);
		$actual = $_->findLast($predicate)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForFindLast()
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
				array('d', 'second')
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
