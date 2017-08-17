<?php

/**
 * @covers Dash\where
 */
class whereTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $properties, $expected)
	{
		$actual = Dash\where($iterable, $properties);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				['age' => 30],
				[]
			),
			'With an empty object' => array(
				(object) [],
				['age' => 30],
				[]
			),
			'With non-empty arrays' => array(
				array(
					0 => ['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
					1 => ['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
					2 => ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					3 => ['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
					4 => ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				),
				['gender' => 'f', 'age' => 30],
				array(
					2 => ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					4 => ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				),
			),
			'With non-empty objects' => array(
				array(
					0 => (object) ['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
					1 => (object) ['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
					2 => (object) ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					3 => (object) ['name' => 'Pete', 'age' => 45, 'gender' => 'm'],
					4 => (object) ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				),
				['gender' => 'f', 'age' => 30],
				array(
					2 => (object) ['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
					4 => (object) ['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
				),
			),
		);
	}
}
