<?php


class matchesPropertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMatchesProperty
	 */
	public function testMatchesProperty($path, $value, $iterable, $expected)
	{
		$matches = Dash\matchesProperty($path, $value);
		$actual = $matches($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function casesForMatchesProperty()
	{
		return array(
			'With a matching array' => array(
				'a.b.c',
				'value',
				array(
					'a' => array(
						'b' => array(
							'c' => 'value'
						)
					)
				),
				true
			),
			'With a non-matching array' => array(
				'a.X.c',
				'value',
				array(
					'a' => array(
						'b' => array(
							'c' => 'value'
						)
					)
				),
				false
			),
			'With a matching object' => array(
				'a.b.c',
				'value',
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				true
			),
			'With a non-matching object' => array(
				'a.X.c',
				'value',
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				false
			),
		);
	}
}
