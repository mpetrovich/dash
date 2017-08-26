<?php

/**
 * @covers Dash\pluck
 */
class pluckTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $path, $expected)
	{
		$this->assertEquals($expected, Dash\pluck($iterable, $path));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				'a.b',
				[]
			],
			'With an array' => [
				[
					[
						'a' => [
							'b' => 'first'
						]
					],
					[
						'X' => 'missing'
					],
					[
						'a' => [
							'b' => 'third'
						]
					],
					[
						'a' => [
							'b' => 'fourth'
						]
					]
				],
				'a.b',
				['first', null, 'third', 'fourth']
			],
		];
	}
}
