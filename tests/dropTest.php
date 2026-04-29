<?php

/**
 * @covers Dash\drop
 * @covers Dash\Curry\drop
 * @covers Dash\Generator\drop
 */
class dropTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $count, $expected)
	{
		$this->assertEquals($expected, Dash\drop($iterable, $count));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $count, $expected)
	{
		$drop = Dash\Curry\drop($count);
		$this->assertEquals($expected, $drop($iterable));
	}

	public function cases()
	{
		return [
			'Indexed array' => [['a', 'b', 'c', 'd'], 2, ['c', 'd']],
			'Associative array' => [['a' => 1, 'b' => 2, 'c' => 3], 1, ['b' => 2, 'c' => 3]],
			'Zero count' => [[1, 2, 3], 0, [1, 2, 3]],
			'Large count' => [[1, 2], 5, []],
			'Negative count with array' => [[1, 2, 3, 4], -1, [4]],
			'Null iterable' => [null, 2, []],
		];
	}

	public function testGenerator()
	{
		$generator = function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 3;
		};

		$result = iterator_to_array(Dash\drop($generator(), 1));
		$this->assertSame(['b' => 2, 'c' => 3], $result);
	}

	public function testGeneratorRejectsNegativeCount()
	{
		$this->expectException(InvalidArgumentException::class);

		$generator = function () {
			yield 1;
			yield 2;
		};

		Dash\drop($generator(), -1);
	}
}
