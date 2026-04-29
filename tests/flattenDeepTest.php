<?php

/**
 * @covers Dash\flattenDeep
 * @covers Dash\Curry\flattenDeep
 * @covers Dash\Generator\flattenDeep
 */
class flattenDeepTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\flattenDeep($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$f = Dash\Curry\flattenDeep();
		$this->assertEquals($expected, $f($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'expected' => [],
			],
			'Nested lists' => [
				'iterable' => [[1, [2, [3, 4]]], 5],
				'expected' => [1, 2, 3, 4, 5],
			],
			'Already flat' => [
				'iterable' => [1, 2, 3],
				'expected' => [1, 2, 3],
			],
		];
	}

	public function testGenerator()
	{
		$gen = (function () {
			yield [1, [2, [3]]];
			yield 4;
		})();

		$result = Dash\flattenDeep($gen);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals([1, 2, 3, 4], iterator_to_array($result, false));
	}
}
