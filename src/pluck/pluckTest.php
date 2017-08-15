<?php

class pluckTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $path, $expected)
	{
		$actual = Dash\pluck($collection, $path);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				'a.b',
				[]
			),
			'With a non-empty array' => array(
				array(
					array(
						'a' => array(
							'b' => 'first'
						)
					),
					array(
						'X' => 'missing'
					),
					array(
						'a' => array(
							'b' => 'third'
						)
					),
					array(
						'a' => array(
							'b' => 'fourth'
						)
					)
				),
				'a.b',
				array('first', null, 'third', 'fourth')
			),
		);
	}
}
