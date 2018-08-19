<?php

/**
 * @covers Dash\size
 * @covers Dash\Curry\size
 * @covers Dash\count
 * @covers Dash\Curry\count
 */
class sizeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertEquals($expected, Dash\size($value));
		$this->assertEquals($expected, Dash\count($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$size = Dash\Curry\size('UTF-8');
		$this->assertEquals($expected, $size($value));

		$count = Dash\Curry\count('UTF-8');
		$this->assertEquals($expected, $count($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
				'expected' => 0,
			],
			'With a zero number' => [
				'value' => 0.0,
				'expected' => 0,
			],
			'With a number' => [
				'value' => 3.14,
				'expected' => 0,
			],
			'With an empty string' => [
				'value' => '',
				'expected' => 0,
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => 5,
			],
			'With a multibyte string' => [
				'value' => 'Björk',
				'expected' => 5,
			],
			'With a DateTime' => [
				'value' => new DateTime(),
				'expected' => 0,
			],
			'With an empty array' => [
				'value' => [],
				'expected' => 0,
			],
			'With an array' => [
				'value' => [1, 2, 3],
				'expected' => 3,
			],
			'With an empty stdClass' => [
				'value' => (object) [],
				'expected' => 0,
			],
			'With an stdClass' => [
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => 3,
			],
			'With an empty ArrayObject' => [
				'value' => new ArrayObject([]),
				'expected' => 0,
			],
			'With an ArrayObject' => [
				'value' => new ArrayObject([1, 2, 3]),
				'expected' => 3,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(3, Dash\size([1, 2, 3]));
		$this->assertSame(7, Dash\size('Beyoncé'));
	}
}
