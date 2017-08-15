<?php

class whereTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $properties, $expected)
	{
		$actual = Dash\where($collection, $properties);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				array('age' => 30),
				[]
			),
			'With an empty object' => array(
				(object) [],
				array('age' => 30),
				[]
			),
			'With non-empty arrays' => array(
				array(
					0 => array('name' => 'Jane', 'age' => 25, 'gender' => 'f'),
					1 => array('name' => 'Mike', 'age' => 30, 'gender' => 'm'),
					2 => array('name' => 'Abby', 'age' => 30, 'gender' => 'f'),
					3 => array('name' => 'Pete', 'age' => 45, 'gender' => 'm'),
					4 => array('name' => 'Kate', 'age' => 30, 'gender' => 'f'),
				),
				array('gender' => 'f', 'age' => 30),
				array(
					2 => array('name' => 'Abby', 'age' => 30, 'gender' => 'f'),
					4 => array('name' => 'Kate', 'age' => 30, 'gender' => 'f'),
				),
			),
			'With non-empty objects' => array(
				array(
					0 => (object) array('name' => 'Jane', 'age' => 25, 'gender' => 'f'),
					1 => (object) array('name' => 'Mike', 'age' => 30, 'gender' => 'm'),
					2 => (object) array('name' => 'Abby', 'age' => 30, 'gender' => 'f'),
					3 => (object) array('name' => 'Pete', 'age' => 45, 'gender' => 'm'),
					4 => (object) array('name' => 'Kate', 'age' => 30, 'gender' => 'f'),
				),
				array('gender' => 'f', 'age' => 30),
				array(
					2 => (object) array('name' => 'Abby', 'age' => 30, 'gender' => 'f'),
					4 => (object) array('name' => 'Kate', 'age' => 30, 'gender' => 'f'),
				),
			),
		);
	}
}
