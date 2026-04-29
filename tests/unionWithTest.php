<?php

/**
 * @covers Dash\unionWith
 * @covers Dash\Curry\unionWith
 */
class unionWithTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $other, $comparator, $expected)
	{
		$this->assertEquals($expected, Dash\unionWith($iterable, $other, $comparator));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $other, $comparator, $expected)
	{
		$f = Dash\Curry\unionWith($other);
		$this->assertEquals($expected, $f($comparator)($iterable));
	}

	public function testMatchesUnionWhenDefaultComparator()
	{
		$a = [1, 3, 5];
		$b = [2, 4, 6];
		$this->assertEquals(
			Dash\union($a, $b),
			Dash\unionWith($a, $b, 'Dash\equal')
		);
	}

	public function cases()
	{
		$byX = function ($v1, $v2) {
			return $v1['x'] === $v2['x'];
		};

		return [
			'With indexed skip duplicate from second' => [
				'iterable' => [1, 3],
				'other' => [2, 1],
				'comparator' => 'Dash\equal',
				'expected' => [1, 3, 2],
			],
			'With null iterable' => [
				'iterable' => null,
				'other' => [1, 2],
				'comparator' => 'Dash\equal',
				'expected' => [1, 2],
			],
			'With associative merge keys' => [
				'iterable' => ['a' => 1, 'c' => 3],
				'other' => ['b' => 2, 'd' => 4],
				'comparator' => 'Dash\equal',
				'expected' => ['a' => 1, 'c' => 3, 'b' => 2, 'd' => 4],
			],
			'With objects dedupe across union' => [
				'iterable' => [['x' => 1]],
				'other' => [['x' => 2], ['x' => 1]],
				'comparator' => $byX,
				'expected' => [['x' => 1], ['x' => 2]],
			],
		];
	}
}
