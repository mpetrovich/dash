<?php

/**
 * @covers Dash\isOdd
 * @covers Dash\Curry\isOdd
 */
class isOddTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isOdd($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isOdd = Dash\Curry\isOdd();
		$this->assertSame($expected, $isOdd($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
				'expected' => false,
			],

			/*
				With string
			 */

			'With an empty string' => [
				'value' => '',
				'expected' => false,
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => false,
			],
			'With a zero integer-like string' => [
				'value' => '0',
				'expected' => false,
			],
			'With a zero double-like string' => [
				'value' => '0.0',
				'expected' => false,
			],
			'With an even integer-like string' => [
				'value' => '6',
				'expected' => false,
			],
			'With an odd integer-like string' => [
				'value' => '5',
				'expected' => true,
			],
			'With an even double-like string' => [
				'value' => '4.9',
				'expected' => false,
			],
			'With an odd double-like string' => [
				'value' => '5.9',
				'expected' => true,
			],

			/*
				With number
			 */

			'With a zero integer' => [
				'value' => 0,
				'expected' => false,
			],
			'With a zero double' => [
				'value' => 0,
				'expected' => false,
			],
			'With an even integer' => [
				'value' => 6,
				'expected' => false,
			],
			'With an even double' => [
				'value' => 4.9,
				'expected' => false,
			],
			'With an odd integer' => [
				'value' => 5,
				'expected' => true,
			],
			'With an odd double' => [
				'value' => 5.9,
				'expected' => true,
			],

			/*
				With non-numeric
			 */

			'With a DateTime' => [
				'value' => new DateTime(),
				'expected' => false,
			],
			'With an empty array' => [
				'value' => [],
				'expected' => false,
			],
			'With an indexed array' => [
				'value' => [3, 8, 2, 5],
				'expected' => false,
			],
			'With an associative array' => [
				'value' => ['a' => 3, 'b' => 2, 'c' => 8, 'd' => 5],
				'expected' => false,
			],
			'With an empty stdClass' => [
				'value' => (object) [],
				'expected' => false,
			],
			'With an stdClass' => [
				'value' => (object) ['a' => 3, 'b' => 2, 'c' => 8, 'd' => 5],
				'expected' => false,
			],
			'With an empty ArrayObject' => [
				'value' => new ArrayObject([]),
				'expected' => false,
			],
			'With an ArrayObject with one element' => [
				'value' => new ArrayObject(['a' => 3]),
				'expected' => false,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\isOdd(3));
		$this->assertSame(false, Dash\isOdd(4));
		$this->assertSame(true, Dash\isOdd(5.9));
		$this->assertSame(false, Dash\isOdd('a'));
	}
}
