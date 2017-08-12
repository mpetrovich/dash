<?php

use Dash\_;

class findValueTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForFindValue
	 */
	public function testStandaloneFindValue($collection, $predicate, $expected)
	{
		$actual = Dash\findValue($collection, $predicate);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForFindValue
	 */
	public function testChainedFindValue($collection, $predicate, $expected)
	{
		$actual = _::chain($collection)->findValue($predicate)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForFindValue()
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
				'second'
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
				'second'
			),
		);
	}
}
