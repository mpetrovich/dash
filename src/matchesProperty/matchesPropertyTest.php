<?php

/**
 * @covers Dash\matchesProperty
 */
class matchesPropertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($path, $value, $iterable, $expected)
	{
		$matches = Dash\matchesProperty($path, $value);
		$this->assertSame($expected, $matches($iterable));
	}

	public function cases()
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
