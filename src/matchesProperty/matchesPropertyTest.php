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
		return [
			'With a matching array' => [
				'a.b.c',
				'value',
				[
					'a' => [
						'b' => [
							'c' => 'value'
						]
					]
				],
				true
			],
			'With a non-matching array' => [
				'a.X.c',
				'value',
				[
					'a' => [
						'b' => [
							'c' => 'value'
						]
					]
				],
				false
			],
			'With a matching object' => [
				'a.b.c',
				'value',
				(object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				true
			],
			'With a non-matching object' => [
				'a.X.c',
				'value',
				(object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				false
			],
		];
	}
}
