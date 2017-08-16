<?php

class dropWhileTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\dropWhile($input, $predicate));
	}

	public function cases()
	{
		return [
			[
				'input' => [2, 4, 6, 7, 8, 10],
				'predicate' => 'Dash\isEven',
				'expected' => [3 => 7, 4 => 8, 5 => 10],
			],
			[
				'input' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => ['d' => 7, 'e' => 8, 'f' => 10],
			],
			[
				'input' => (object) [2, 4, 6, 7, 8, 10],
				'predicate' => 'Dash\isEven',
				'expected' => (object) [3 => 7, 4 => 8, 5 => 10],
			],
			[
				'input' => (object) ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => (object) ['d' => 7, 'e' => 8, 'f' => 10],
			],
		];
	}
}
