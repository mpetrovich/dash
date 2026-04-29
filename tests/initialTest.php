<?php

/**
 * @covers Dash\initial
 * @covers Dash\init
 * @covers Dash\Curry\initial
 * @covers Dash\Curry\init
 * @covers Dash\Generator\initial
 */
class initialTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\initial($iterable));
		$this->assertEquals($expected, Dash\init($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$i = Dash\Curry\initial();
		$this->assertEquals($expected, $i($iterable));

		$i2 = Dash\Curry\init();
		$this->assertEquals($expected, $i2($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'expected' => [],
			],
			'With empty array' => [
				'iterable' => [],
				'expected' => [],
			],
			'With single element' => [
				'iterable' => [1],
				'expected' => [],
			],
			'With indexed array' => [
				'iterable' => [1, 2, 3],
				'expected' => [1, 2],
			],
			'With associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => ['a' => 1, 'b' => 2],
			],
		];
	}

	public function testGenerator()
	{
		$gen = (function () {
			yield 1;
			yield 2;
			yield 3;
		})();

		$r = Dash\initial($gen);
		$this->assertInstanceOf(Generator::class, $r);
		$this->assertEquals([1, 2], iterator_to_array($r, false));
	}
}
