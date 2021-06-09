<?php

/**
 * @covers Dash\dropWhile
 */
class dropWhileTest extends PHPUnit\Framework\TestCase
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
			'With an indexed array' => [
				'input' => [2, 4, 6, 7, 8, 10],
				'predicate' => 'Dash\isEven',
				'expected' => [7, 8, 10],
			],
			'With an associative array' => [
				'input' => ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => ['d' => 7, 'e' => 8, 'f' => 10],
			],
			'With an stdClass' => [
				'input' => (object) ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10],
				'predicate' => 'Dash\isEven',
				'expected' => ['d' => 7, 'e' => 8, 'f' => 10],
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10]),
				'predicate' => 'Dash\isEven',
				'expected' => ['d' => 7, 'e' => 8, 'f' => 10],
			],
		];
	}

	public function testPredicate()
	{
		$input = ['a' => 2];

		$predicate = function ($value, $key, $iterable) use ($input) {
			$this->assertSame(2, $value);
			$this->assertSame('a', $key);
			$this->assertSame($input, $iterable);
		};

		Dash\dropWhile($input, $predicate);
	}
}
