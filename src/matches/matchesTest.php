<?php


class matchesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMatches
	 */
	public function testMatches($properties, $value, $expected)
	{
		$matches = Dash\matches($properties);
		$actual = $matches($value);
		$this->assertEquals($expected, $actual);
	}

	public function casesForMatches()
	{
		return array(
			'With matching arrays' => array(
				['b' => 2, 'd' => 4],
				['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				true
			),
			'With non-matching arrays where keys do not match' => array(
				['b' => 2, 'x' => 4],
				['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				false
			),
			'With non-matching arrays where values do not match' => array(
				['b' => 2, 'd' => 9],
				['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				false
			),
			'With matching objects' => array(
				(object) ['b' => 2, 'd' => 4],
				(object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				true
			),
			'With non-matching objects where keys do not match' => array(
				(object) ['b' => 2, 'x' => 4],
				(object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				false
			),
			'With non-matching objects where values do not match' => array(
				(object) ['b' => 2, 'd' => 9],
				(object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				false
			),
		);
	}
}
