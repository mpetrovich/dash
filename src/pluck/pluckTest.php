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
		$actual = Dash\pluck($iterable, $path);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => [
				[],
				'a.b',
				[]
			],
			'With an array' => array(
				array(
					array(
						'a' => [
							'b' => 'first'
						]
					),
					[
						'X' => 'missing'
					],
					array(
						'a' => [
							'b' => 'third'
						]
					),
					array(
						'a' => [
							'b' => 'fourth'
						]
					)
				),
				'a.b',
				['first', null, 'third', 'fourth']
			),
		);
	}
}
