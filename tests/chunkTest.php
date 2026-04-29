<?php

/**
 * @covers Dash\chunk
 * @covers Dash\splitEvery
 * @covers Dash\Curry\chunk
 * @covers Dash\Curry\splitEvery
 * @covers Dash\Generator\chunk
 */
class chunkTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $size, $expected)
	{
		$this->assertEquals($expected, Dash\chunk($iterable, $size));
	}

	/**
	 * @dataProvider cases
	 */
	public function testAlias($iterable, $size, $expected)
	{
		$this->assertEquals($expected, Dash\splitEvery($iterable, $size));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $size, $expected)
	{
		$chunk = Dash\Curry\chunk($size);
		$this->assertEquals($expected, $chunk($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurriedAlias($iterable, $size, $expected)
	{
		$splitEvery = Dash\Curry\splitEvery($size);
		$this->assertEquals($expected, $splitEvery($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'size' => 2,
				'expected' => [],
			],
			'With empty array' => [
				'iterable' => [],
				'size' => 2,
				'expected' => [],
			],
			'With indexed array' => [
				'iterable' => [1, 2, 3, 4, 5],
				'size' => 2,
				'expected' => [[1, 2], [3, 4], [5]],
			],
			'With associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3],
				'size' => 2,
				'expected' => [['a' => 1, 'b' => 2], ['c' => 3]],
			],
			'With stdClass' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'size' => 2,
				'expected' => [['a' => 1, 'b' => 2], ['c' => 3]],
			],
			'With size 1' => [
				'iterable' => [1, 2, 3],
				'size' => 1,
				'expected' => [[1], [2], [3]],
			],
			'With size larger than iterable' => [
				'iterable' => [1, 2, 3],
				'size' => 9,
				'expected' => [[1, 2, 3]],
			],
			'With size 0' => [
				'iterable' => [1, 2, 3],
				'size' => 0,
				'expected' => [],
			],
			'With negative size' => [
				'iterable' => [1, 2, 3],
				'size' => -1,
				'expected' => [],
			],
		];
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => 1;
			yield 'b' => 2;
			yield 'c' => 3;
		})();

		$result = Dash\chunk($iterable, 2);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals(
			[['a' => 1, 'b' => 2], ['c' => 3]],
			iterator_to_array($result, false)
		);
	}
}
