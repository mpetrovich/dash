<?php

/**
 * @covers Dash\contains
 * @covers Dash\Curry\contains
 * @covers Dash\includes
 * @covers Dash\Curry\includes
 */
class containsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $target, $comparator, $expected)
	{
		$this->assertSame($expected, Dash\contains($iterable, $target, $comparator));
		$this->assertSame($expected, Dash\includes($iterable, $target, $comparator));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $target, $comparator, $expected)
	{
		$contains = Dash\Curry\contains($target, $comparator);
		$this->assertSame($expected, $contains($iterable));

		$includes = Dash\Curry\includes($target, $comparator);
		$this->assertSame($expected, $includes($iterable));
	}

	public function cases()
	{
		return [
			'With null' => [
				'iterable' => null,
				'target' => 3,
				'predicate' => 'Dash\equal',
				'expected' => false,
			],
			'With an empty array' => [
				'iterable' => [],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],

			/*
				With indexed array
			 */

			'With an indexed array and a loose comparator and a matching value' => [
				'iterable' => [1, '2', 3],
				'target' => 2,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With an indexed array and a loose comparator and no matching value' => [
				'iterable' => [1, '2', 3],
				'target' => 2.1,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an indexed array and a strict comparator and a matching value' => [
				'iterable' => [1, '2', 3],
				'target' => '2',
				'comparator' => 'Dash\identical',
				'expected' => true,
			],
			'With an indexed array and a strict comparator and no matching value' => [
				'iterable' => [1, '2', 3],
				'target' => 2,
				'comparator' => 'Dash\identical',
				'expected' => false,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an stdClass and a matching value' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With an stdClass and no matching value' => [
				'iterable' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'target' => 4,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject(),
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
			'With an ArrayObject and a matching value' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'target' => 3,
				'comparator' => 'Dash\equal',
				'expected' => true,
			],
			'With an ArrayObject and no matching value' => [
				'iterable' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'target' => 4,
				'comparator' => 'Dash\equal',
				'expected' => false,
			],
		];
	}

	public function testPredicateArgs()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iterated = [];

		$comparator = function ($target, $value) use (&$iterated) {
			$iterated[] = $value;
			return false;
		};
		$target = 9;

		$result = Dash\contains($iterable, $target, $comparator);

		$this->assertFalse($result);
		$this->assertSame(array_values($iterable), $iterated);
	}

	/**
	 * @dataProvider casesDefaultPredicate
	 */
	public function testDefaultPredicate($iterable, $target, $expected)
	{
		$this->assertSame($expected, Dash\contains($iterable, $target));
		$this->assertSame($expected, Dash\includes($iterable, $target));
	}

	public function casesDefaultPredicate()
	{
		return [
			'With an indexed array and a matching value' => [
				'iterable' => [1, '2', 3],
				'target' => 2,
				'expected' => true,
			],
			'With an indexed array and no matching value' => [
				'iterable' => [1, '2', 3],
				'target' => 2.1,
				'expected' => false,
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		$target = 3;

		try {
			Dash\contains($iterable, $target);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\contains expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}

		try {
			Dash\includes($iterable, $target);
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\contains expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With an empty string' => [
				'iterable' => '',
				'type' => 'string',
			],
			'With a string' => [
				'iterable' => 'hello',
				'type' => 'string',
			],
			'With a zero number' => [
				'iterable' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'iterable' => 3.14,
				'type' => 'double',
			],
			'With a DateTime' => [
				'iterable' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\contains([1, '2', 3], 2));
		$this->assertSame(false, Dash\contains([1, '2', 3], 2, 'Dash\identical'));
	}
}
