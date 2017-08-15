<?php

class getTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $path, $expected)
	{
		$actual = Dash\get($iterable, $path, 'default');
		$this->assertEquals($expected, $actual);
	}

	public function cases()
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
