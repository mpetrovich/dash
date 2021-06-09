<?php

/**
 * @covers Dash\takeWhile
 */
class takeWhileTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\takeWhile($input, $predicate));
	}

	public function cases()
	{
		return [
			[
				'input' => [2, 4, 6, 7, 8, 10],
				'predicate' => 'Dash\isEven',
				'expected' => [2, 4, 6],
			],
			[
				'input' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6],
			],
			[
				'input' => (object) [2, 4, 6, 7, 8, 10],
				'predicate' => 'Dash\isEven',
				'expected' => [2, 4, 6],
			],
			[
				'input' => (object) ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6],
			],
		];
	}
}
