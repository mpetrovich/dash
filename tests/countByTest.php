<?php

/**
 * @covers Dash\countBy
 * @covers Dash\Curry\countBy
 */
class countByTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $iteratee, $expected)
	{
		$this->assertSame($expected, Dash\countBy($iterable, $iteratee));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $iteratee, $expected)
	{
		$countBy = Dash\Curry\countBy($iteratee, null);
		$this->assertSame($expected, $countBy($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [null, 'Dash\isOdd', []],
			'With empty array' => [[], 'Dash\isOdd', []],
			'With callable iteratee' => [[3, 1, 2, 4], 'Dash\isOdd', [true => 2, false => 2]],
			'With path iteratee' => [
				[
					['first' => 'John', 'last' => 'Doe'],
					['first' => 'Alice', 'last' => 'Hart'],
					['first' => 'Anonymous'],
					['first' => 'Jane', 'last' => 'Doe'],
				],
				'last',
				['Doe' => 2, 'Hart' => 1, '' => 1],
			],
		];
	}
}
