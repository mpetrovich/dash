<?php

/**
 * @covers Dash\reduceRight
 * @covers Dash\Curry\reduceRight
 */
class reduceRightTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$iteratee = function ($result, $value) {
			$result[] = $value;
			return $result;
		};

		$this->assertSame([3, 2, 1], Dash\reduceRight([1, 2, 3], $iteratee, []));
		$this->assertSame([], Dash\reduceRight(null, $iteratee, []));
	}

	public function testCurried()
	{
		$iteratee = function ($result, $value) {
			$result[] = $value;
			return $result;
		};

		$f = Dash\Curry\reduceRight($iteratee, []);
		$this->assertSame([3, 2, 1], $f([1, 2, 3]));
	}

	public function testIterateeArgsUseRightToLeftOrder()
	{
		$visited = [];
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iteratee = function ($result, $value, $key) use (&$visited) {
			$visited[] = [$key, $value];
			return $result + $value;
		};

		$result = Dash\reduceRight($iterable, $iteratee, 0);

		$this->assertSame(6, $result);
		$this->assertSame([['c', 3], ['b', 2], ['a', 1]], $visited);
	}
}
