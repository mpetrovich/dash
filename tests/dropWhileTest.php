<?php

/**
 * @covers Dash\dropWhile
 * @covers Dash\Curry\dropWhile
 * @covers Dash\Generator\dropWhile
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

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $predicate, $expected)
	{
		$f = Dash\Curry\dropWhile($predicate);
		$this->assertEquals($expected, $f($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'predicate' => 'Dash\isEven',
				'expected' => [],
			],
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

	/**
	 * @dataProvider casesGenerator
	 */
	public function testGenerator($input, $predicate, $expected)
	{
		$result = Dash\dropWhile($input, $predicate);
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
			'With indexed array' => [
				'input' => $generator([2, 4, 6, 7, 8, 10]),
				'predicate' => 'Dash\isEven',
				'expected' => [7, 8, 10],
			],
			'With associative array' => [
				'input' => $generator(['a' => 2, 'b' => 4, 'c' => 6, 'd' => 7, 'e' => 8, 'f' => 10]),
				'predicate' => 'Dash\isEven',
				'expected' => ['d' => 7, 'e' => 8, 'f' => 10],
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
			yield 8;
		};
		$predicate = function ($value) use (&$calls) {
			$calls++;
			return Dash\isEven($value);
		};

		$result = Dash\dropWhile($generator(), $predicate);
		$this->assertSame(0, $calls);
		$this->assertSame([7, 8], iterator_to_array($result));
		$this->assertSame(3, $calls);
	}
}
