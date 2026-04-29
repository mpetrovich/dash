<?php

/**
 * @covers Dash\intersectionWith
 * @covers Dash\Curry\intersectionWith
 */
class intersectionWithTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $other, $comparator, $expected)
	{
		$this->assertEquals($expected, Dash\intersectionWith($iterable, $other, $comparator));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $other, $comparator, $expected)
	{
		$f = Dash\Curry\intersectionWith($other);
		$this->assertEquals($expected, $f($comparator)($iterable));
	}

	public function testMatchesIntersectionDefaultComparator()
	{
		$a = [1, 2, 3, 4, 5];
		$b = ['2', '4'];
		$this->assertEquals(
			Dash\intersection($a, $b),
			Dash\intersectionWith($a, $b, 'Dash\equal')
		);
	}

	public function cases()
	{
		$byX = function ($v1, $v2) {
			return $v1['x'] === $v2['x'];
		};

		return [
			'With null iterable' => [
				'iterable' => null,
				'other' => [1],
				'comparator' => 'Dash\equal',
				'expected' => [],
			],
			'With indexed loose equal' => [
				'iterable' => [1, 2, 3, 4, 5],
				'other' => ['2', '4'],
				'comparator' => 'Dash\equal',
				'expected' => [2, 4],
			],
			'With associative first' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'other' => ['x' => 2, 'y' => 4],
				'comparator' => 'Dash\equal',
				'expected' => ['b' => 2],
			],
			'With objects compared by field' => [
				'iterable' => [['x' => 1], ['x' => 2]],
				'other' => [['x' => 2]],
				'comparator' => $byX,
				'expected' => [['x' => 2]],
			],
		];
	}
}
