<?php

/**
 * @covers Dash\compact
 * @covers Dash\Curry\compact
 * @covers Dash\Generator\compact
 */
class compactTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\compact($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$compact = Dash\Curry\compact();
		$this->assertEquals($expected, $compact($iterable));
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
			'With indexed array' => [
				'iterable' => [0, 1, false, 2, '', 3, null, '0', []],
				'expected' => [1, 2, 3],
			],
			'With associative array' => [
				'iterable' => ['a' => 0, 'b' => 2, 'c' => false, 'd' => 4, 'e' => ''],
				'expected' => ['b' => 2, 'd' => 4],
			],
			'With stdClass' => [
				'iterable' => (object) ['a' => 0, 'b' => 2, 'c' => false, 'd' => 4, 'e' => null],
				'expected' => ['b' => 2, 'd' => 4],
			],
			'With ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 0, 'b' => 2, 'c' => false, 'd' => 4]),
				'expected' => ['b' => 2, 'd' => 4],
			],
		];
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => 0;
			yield 'b' => 2;
			yield 'c' => false;
			yield 'd' => 4;
			yield 'e' => null;
		})();

		$result = Dash\compact($iterable);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals(['b' => 2, 'd' => 4], iterator_to_array($result));
	}

	public function testMatchesFilterIdentity()
	{
		$iterable = [0, 1, false, 2, '', 3, null];
		$this->assertEquals(
			Dash\filter($iterable, 'Dash\identity'),
			Dash\compact($iterable)
		);
	}
}
