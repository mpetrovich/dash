<?php

/**
 * @covers Dash\toObject
 * @covers Dash\Curry\toObject
 */
class toObjectTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertEquals($expected, Dash\toObject($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$toObject = Dash\Curry\toObject();
		$this->assertEquals($expected, $toObject($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
				'expected' => (object) [],
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => (object) ['hello'],
			],
			'With a number' => [
				'value' => 3.14,
				'expected' => (object) [3.14],
			],
			'With a DateTime' => [
				'value' => new DateTime('@0'),
				'expected' => (object) [
					'date' => '1970-01-01 00:00:00.000000',
					'timezone_type' => 1,
					'timezone' => '+00:00',
				],
			],

			/*
				With array
			 */

			'With an empty array' => [
				'value' => [],
				'expected' => (object) [],
			],
			'With an array with one element' => [
				'value' => ['a' => 3],
				'expected' => (object) ['a' => 3],
			],
			'With an indexed array' => [
				'value' => [3, 8, 2, 5],
				'expected' => (object) [3, 8, 2, 5],
			],
			'With an associative array' => [
				'value' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'expected' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'value' => (object) [],
				'expected' => (object) [],
			],
			'With an stdClass of an array with one element' => [
				'value' => (object) ['a' => 3],
				'expected' => (object) ['a' => 3],
			],
			'With an stdClass of an indexed array' => [
				'value' => (object) [3, 8, 2, 5],
				'expected' => (object) [3, 8, 2, 5],
			],
			'With an stdClass of an associative array' => [
				'value' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'expected' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'value' => new ArrayObject([]),
				'expected' => (object) [],
			],
			'With an ArrayObject with one element' => [
				'value' => new ArrayObject(['a' => 3]),
				'expected' => (object) ['a' => 3],
			],
			'With an ArrayObject of an indexed array' => [
				'value' => new ArrayObject([3, 8, 2, 5]),
				'expected' => (object) [3, 8, 2, 5],
			],
			'With an ArrayObject of an associative array' => [
				'value' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'expected' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],
		];
	}

	public function testExamples()
	{
		$this->assertEquals((object) ['a' => 1, 'b' => 2], Dash\toObject(['a' => 1, 'b' => 2]));
		$this->assertEquals((object) ['a' => 1, 'b' => 2], Dash\toObject(new ArrayObject(['a' => 1, 'b' => 2])));
	}
}
