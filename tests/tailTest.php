<?php

/**
 * @covers Dash\tail
 * @covers Dash\rest
 * @covers Dash\Curry\tail
 * @covers Dash\Curry\rest
 * @covers Dash\Generator\tail
 */
class tailTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\tail($iterable));
		$this->assertEquals($expected, Dash\rest($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$t = Dash\Curry\tail();
		$this->assertEquals($expected, $t($iterable));

		$t2 = Dash\Curry\rest();
		$this->assertEquals($expected, $t2($iterable));
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
				'expected' => [2, 3],
			],
			'With associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => ['b' => 2, 'c' => 3],
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

		$r = Dash\tail($gen);
		$this->assertInstanceOf(Generator::class, $r);
		$this->assertEquals([2, 3], iterator_to_array($r, false));
	}
}
