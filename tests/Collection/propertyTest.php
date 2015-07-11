<?php

use Dash\Collection;
use Dash\Container;

class propertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForProperty
	 */
	public function testProperty($path, $object, $expected)
	{
		$getter = Collection\property($path, 'default');
		$this->assertEquals($expected, $getter($object));
	}

	public function casesForProperty()
	{
		return array(
			'With a valid path for an object' => array(
				'a.b.c',
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				'value'
			),
			'With an invalid path for an object' => array(
				'a.X.c',
				(object) array(
					'a' => (object) array(
						'b' => (object) array(
							'c' => 'value'
						)
					)
				),
				'default'
			),
			'With a valid array index' => array(
				'a.1.b',
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
				'value'
			),
			'With an invalid array index' => array(
				'a.2.b',
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
				'default'
			),
			'With a matching direct array key' => array(
				'a.b.c',
				array('a.b.c' => 'value'),
				'value'
			),
			'With a matching direct object property' => array(
				'a.b.c',
				(object) array('a.b.c' => 'value'),
				'value'
			),
		);
	}
}
