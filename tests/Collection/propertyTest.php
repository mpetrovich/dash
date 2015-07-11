<?php

use Dash\Collection;

class propertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForProperty
	 */
	public function testProperty($collection, $path, $expected)
	{
		$getter = Collection\property($path, 'default');
		$this->assertEquals($expected, $getter($collection));
	}

	public function casesForProperty()
	{
		return array(
			'With a valid path for an object' => array(
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				'a.b.c',
				'value'
			),
			'With an invalid path for an object' => array(
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				'a.X.c',
				'default'
			),
			'With a valid array index' => array(
				(object) array(
					'a' => array(
						(object) array(
							'x' => (object) array(
								'y' => 'other'
							)
						),
						(object) array(
							'b' => 'value'
						),
					)
				),
				'a.1.b',
				'value'
			),
			'With an invalid array index' => array(
				(object) array(
					'a' => array(
						(object) array(
							'x' => (object) array(
								'y' => 'other'
							)
						),
						(object) array(
							'b' => 'value'
						),
					)
				),
				'a.2.b',
				'default'
			),
			'With a matching direct array key' => array(
				array('a.b.c' => 'value'),
				'a.b.c',
				'value'
			),
			'With a matching direct object property' => array(
				(object) array('a.b.c' => 'value'),
				'a.b.c',
				'value'
			),
		);
	}
}
