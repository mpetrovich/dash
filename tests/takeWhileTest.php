<?php

/**
 * @covers Dash\takeWhile
 * @covers Dash\Generator\takeWhile
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

	/**
	 * @dataProvider casesGenerator
	 */
	public function testGenerator($input, $predicate, $expected)
	{
		$result = Dash\takeWhile($input, $predicate);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertEquals($expected, iterator_to_array($result));
	}

	public function casesGenerator()
	{
		$generator = function ($iterable) {
			foreach ((array) $iterable as $key => $value) {
				yield $key => $value;
			}
		};

		return [
			[
				'input' => $generator([2, 4, 6, 7, 8, 10]),
				'predicate' => 'Dash\isEven',
				'expected' => [2, 4, 6],
			],
			[
				'input' => $generator(['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10]),
				'predicate' => 'Dash\isEven',
				'expected' => ['a' => 2, 'b' => 4, 'c' => 6],
			],
		];
	}

	public function testGeneratorIsLazy()
	{
		$calls = 0;
		$generator = function () {
			yield 2;
			yield 4;
			yield 7;
		};
		$predicate = function ($value) use (&$calls) {
			$calls++;
			return Dash\isEven($value);
		};

		$result = Dash\takeWhile($generator(), $predicate);
		$this->assertSame(0, $calls);
		$this->assertSame([2, 4], iterator_to_array($result));
		$this->assertSame(3, $calls);
	}
}
