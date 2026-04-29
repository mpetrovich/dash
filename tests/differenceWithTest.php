<?php

/**
 * @covers Dash\differenceWith
 * @covers Dash\Curry\differenceWith
 */
class differenceWithTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $other, $comparator, $expected)
	{
		$this->assertEquals($expected, Dash\differenceWith($iterable, $other, $comparator));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $other, $comparator, $expected)
	{
		$step1 = Dash\Curry\differenceWith($other);
		$step2 = $step1($comparator);
		$this->assertEquals($expected, $step2($iterable));
	}

	public function cases()
	{
		$byX = function ($a, $b) {
			return $a['x'] === $b['x'];
		};

		return [
			'With null iterable' => [
				'iterable' => null,
				'other' => [1, 2],
				'comparator' => 'Dash\equal',
				'expected' => [],
			],
			'With empty first' => [
				'iterable' => [],
				'other' => [1, 2],
				'comparator' => 'Dash\equal',
				'expected' => [],
			],
			'With indexed and default loose equal' => [
				'iterable' => [1, 2, 3, 4, 5],
				'other' => ['2', 4],
				'comparator' => 'Dash\equal',
				'expected' => [1, 3, 5],
			],
			'With objects compared by field' => [
				'iterable' => [['x' => 1], ['x' => 2], ['x' => 3]],
				'other' => [['x' => 2]],
				'comparator' => $byX,
				'expected' => [['x' => 1], ['x' => 3]],
			],
			'With associative first' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'other' => ['a' => 2, 'b' => 2],
				'comparator' => 'Dash\equal',
				'expected' => ['a' => 1, 'c' => 3],
			],
		];
	}
}
