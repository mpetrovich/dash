<?php

/**
 * @covers Dash\uniqueBy
 * @covers Dash\uniqBy
 * @covers Dash\distinctBy
 * @covers Dash\Curry\uniqueBy
 * @covers Dash\Curry\uniqBy
 * @covers Dash\Curry\distinctBy
 * @covers Dash\Generator\uniqueBy
 */
class uniqueByTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $iteratee, $expected)
	{
		$this->assertEquals($expected, Dash\uniqueBy($iterable, $iteratee));
		$this->assertEquals($expected, Dash\uniqBy($iterable, $iteratee));
		$this->assertEquals($expected, Dash\distinctBy($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $iteratee, $expected)
	{
		$u = Dash\Curry\uniqueBy($iteratee);
		$this->assertEquals($expected, $u($iterable));

		$u2 = Dash\Curry\uniqBy($iteratee);
		$this->assertEquals($expected, $u2($iterable));

		$u3 = Dash\Curry\distinctBy($iteratee);
		$this->assertEquals($expected, $u3($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'iteratee' => 'Dash\identity',
				'expected' => [],
			],
			'With empty array' => [
				'iterable' => [],
				'iteratee' => 'Dash\identity',
				'expected' => [],
			],
			'With indexed array and identity' => [
				'iterable' => [1, 2, 1, 3, 2],
				'iteratee' => 'Dash\identity',
				'expected' => [1, 2, 3],
			],
			'With associative array and identity' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 1, 'd' => 3],
				'iteratee' => 'Dash\identity',
				'expected' => ['a' => 1, 'b' => 2, 'd' => 3],
			],
			'With path iteratee' => [
				'iterable' => [
					['id' => 1, 'n' => 'a'],
					['id' => 1, 'n' => 'b'],
					['id' => 2, 'n' => 'c'],
				],
				'iteratee' => 'id',
				'expected' => [
					['id' => 1, 'n' => 'a'],
					['id' => 2, 'n' => 'c'],
				],
			],
			'With callable iteratee' => [
				'iterable' => [1.1, 1.9, 2.1, 2.4],
				'iteratee' => Dash\unary('floor'),
				'expected' => [1.1, 2.1],
			],
			'With stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 1],
				'iteratee' => 'Dash\identity',
				'expected' => ['a' => 1, 'b' => 2],
			],
		];
	}

	public function testGeneratorLazy()
	{
		$iterable = (function () {
			yield 1;
			yield 2;
			yield 1;
			yield 3;
		})();

		$result = Dash\uniqueBy($iterable, 'Dash\identity');
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals([1, 2, 3], iterator_to_array($result));
	}

	public function testGeneratorPreservesKeysWhenNotIndexed()
	{
		$iterable = (function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 1;
		})();

		$result = Dash\uniqueBy($iterable, 'Dash\identity');
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals(['a' => 1, 'b' => 2], iterator_to_array($result));
	}
}
