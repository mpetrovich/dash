<?php

use Dash\_;

class pluckTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForPluck
	 */
	public function testStandalonePluck($collection, $path, $expected)
	{
		$actual = Dash\pluck($collection, $path);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @dataProvider casesForPluck
	 */
	public function testChainedPluck($collection, $path, $expected)
	{
		$actual = _::chain($collection)->pluck($path)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForPluck()
	{
		return array(
			'With an empty array' => array(
				array(),
				'a.b',
				array()
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
