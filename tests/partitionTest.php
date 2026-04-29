<?php

/**
 * @covers Dash\partition
 * @covers Dash\Curry\partition
 */
class partitionTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\partition($iterable, $predicate));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $predicate, $expected)
	{
		$partition = Dash\Curry\partition($predicate);
		$this->assertEquals($expected, $partition($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'predicate' => 'Dash\isOdd',
				'expected' => [[], []],
			],
			'With empty array' => [
				'iterable' => [],
				'predicate' => 'Dash\isOdd',
				'expected' => [[], []],
			],
			'With indexed array' => [
				'iterable' => [1, 2, 3, 4],
				'predicate' => 'Dash\isEven',
				'expected' => [[2, 4], [1, 3]],
			],
			'With associative array' => [
				'iterable' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'predicate' => 'Dash\isEven',
				'expected' => [['b' => 2, 'd' => 4], ['a' => 1, 'c' => 3]],
			],
			'With matchesProperty field' => [
				'iterable' => [
					['name' => 'John', 'active' => false],
					['name' => 'Mary', 'active' => true],
				],
				'predicate' => 'active',
				'expected' => [
					[['name' => 'Mary', 'active' => true]],
					[['name' => 'John', 'active' => false]],
				],
			],
		];
	}

	public function testMatchesFilterAndReject()
	{
		$iterable = [1, 2, 3, 4];
		$predicate = 'Dash\isEven';
		list($pass, $fail) = Dash\partition($iterable, $predicate);
		$this->assertEquals(Dash\filter($iterable, $predicate), $pass);
		$this->assertEquals(Dash\reject($iterable, $predicate), $fail);
	}
}
