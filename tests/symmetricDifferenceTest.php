<?php

/**
 * @covers Dash\symmetricDifference
 * @covers Dash\Curry\symmetricDifference
 */
class symmetricDifferenceTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $other, $expected)
	{
		$this->assertEquals($expected, Dash\symmetricDifference($iterable, $other));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $other, $expected)
	{
		$f = Dash\Curry\symmetricDifference($other);
		$this->assertEquals($expected, $f($iterable));
	}

	public function cases()
	{
		return [
			'With indexed arrays' => [
				'iterable' => [1, 2, 3],
				'other' => [2, 4],
				'expected' => [1, 3, 4],
			],
			'With associative arrays' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'other' => ['x' => 2, 'y' => 4],
				'expected' => ['a' => 1, 'c' => 3, 'y' => 4],
			],
			'With null left' => [
				'iterable' => null,
				'other' => [1, 2],
				'expected' => [1, 2],
			],
			'With null right' => [
				'iterable' => [1, 2],
				'other' => null,
				'expected' => [1, 2],
			],
			'With identical arrays' => [
				'iterable' => [1, 2, 3],
				'other' => [1, 2, 3],
				'expected' => [],
			],
		];
	}
}
