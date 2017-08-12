<?php

use Dash\_;

class findKeyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForFindKey
	 */
	public function testStandaloneFindKey($collection, $predicate, $expected)
	{
		$actual = Dash\findKey($collection, $predicate);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForFindKey
	 */
	public function testChainedFindKey($collection, $predicate, $expected)
	{
		$_ = new _($collection);
		$actual = $_->findKey($predicate)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForFindKey()
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
				'b'
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
				'd'
			),
		);
	}
}
