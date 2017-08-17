<?php


class propertyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForProperty
	 */
	public function testProperty($iterable, $path, $expected)
	{
		$getter = Dash\property($path, 'default');
		$this->assertEquals($expected, $getter($iterable));
	}

	public function casesForProperty()
	{
		return array(
			'With a valid path for an object' => array(
				(object) array(
					'a' => (object) array(
						'b' => (object) [
							'c' => 'value'
						]
					)
				),
				'a.b.c',
				'value'
			),
			'With an invalid path for an object' => array(
				(object) array(
					'a' => (object) array(
						'b' => (object) [
							'c' => 'value'
						]
					)
				),
				'a.X.c',
				'default'
			),
			'With a valid array index' => array(
				(object) array(
					'a' => array(
						(object) array(
							'x' => (object) [
								'y' => 'other'
							]
						),
						(object) [
							'b' => 'value'
						],
					)
				),
				'a.1.b',
				'value'
			),
			'With an invalid array index' => array(
				(object) array(
					'a' => array(
						(object) array(
							'x' => (object) [
								'y' => 'other'
							]
						),
						(object) [
							'b' => 'value'
						],
					)
				),
				'a.2.b',
				'default'
			),
			'With a matching direct array key' => array(
				['a.b.c' => 'value'],
				'a.b.c',
				'value'
			),
			'With a matching direct object property' => array(
				(object) ['a.b.c' => 'value'],
				'a.b.c',
				'value'
			),
		);
	}
}
