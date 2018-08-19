<?php

/**
 * @covers Dash\equal
 * @covers Dash\Curry\equal
 */
class equalTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($a, $b, $expected)
	{
		$this->assertSame($expected, Dash\equal($a, $b));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($a, $b, $expected)
	{
		$equal = Dash\Curry\equal($b);
		$this->assertSame($expected, $equal($a));
	}

	public function cases()
	{
		return [
			'With identical numbers' => [
				'a' => 3,
				'b' => 3,
				'expected' => true,
			],
			'With two equal but non-identical numbers' => [
				'a' => 123,
				'b' => 123.0,
				'expected' => true,
			],
			'With equal but not identical string/integer values' => [
				'a' => '3',
				'b' => 3,
				'expected' => true,
			],
			'With equal but not identical boolean/integer values' => [
				'a' => true,
				'b' => 1,
				'expected' => true,
			],
			'With equal but not identical null/integer values' => [
				'a' => null,
				'b' => 0,
				'expected' => true,
			],
			'With inequal values of the same type' => [
				'a' => 4,
				'b' => 3,
				'expected' => false,
			],
			'With inequal values of different types' => [
				'a' => '4',
				'b' => 3,
				'expected' => false,
			],
			'With two identical arrays' => [
				'a' => [1, 2, 3],
				'b' => [1, 2, 3],
				'expected' => true,
			],
			'With two arrays containing loosely equal values' => [
				'a' => [null, 1, 2, 3],
				'b' => [0, 1, '2', 3],
				'expected' => true,
			],
			'With two arrays containing identical values in different orders' => [
				'a' => [1, 2, 3],
				'b' => [3, 2, 1],
				'expected' => false,
			],
			'With two arrays containing identical values but different keys' => [
				'a' => ['a' => 1, 'b' => 2, 'c' => 3],
				'b' => ['a' => 1, 'd' => 2, 'c' => 3],
				'expected' => false,
			],
			'With two arrays containing equal but not identical nested arrays' => [
				'a' => ['a' => [1, 2], 'b' => [3, 4, 5]],
				'b' => ['a' => [1, '2'], 'b' => [3.0, 4, 5]],
				'expected' => true,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\equal(3, '3'));
		$this->assertSame(true, Dash\equal(3, 3));
		$this->assertSame(true, Dash\equal([1, 2, 3], [1, '2', 3]));
		$this->assertSame(false, Dash\equal([1, 2, 3], [3, 2, 1]));
	}
}
