<?php

/**
 * @covers Dash\apply
 * @covers Dash\Curry\apply
 */
class applyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $expected)
	{
		$func = function () use ($args) {
			$this->assertSame(Dash\values($args), array_values(func_get_args()));
			return Dash\sum(func_get_args());
		};

		$this->assertSame($expected, Dash\apply($func, $args));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($args, $expected)
	{
		$func = function () use ($args) {
			$this->assertSame(Dash\values($args), array_values(func_get_args()));
			return Dash\sum(func_get_args());
		};

		$apply = Dash\Curry\apply($func);
		$this->assertSame($expected, $apply($args));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'args' => [],
				'expected' => 0,
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'args' => [3],
				'expected' => 3,
			],
			'With an indexed array' => [
				'args' => [1, 2, 3, 4],
				'expected' => 10,
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'args' => ['a' => 3],
				'expected' => 3,
			],
			'With an associative array' => [
				'args' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => 10,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'args' => (object) [],
				'expected' => 0,
			],
			'With an stdClass with one element' => [
				'args' => (object) ['a' => 3],
				'expected' => 3,
			],
			'With an stdClass' => [
				'args' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => 10,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'args' => new ArrayObject([]),
				'expected' => 0,
			],
			'With an ArrayObject with one element' => [
				'args' => new ArrayObject(['a' => 3]),
				'expected' => 3,
			],
			'With an ArrayObject' => [
				'args' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'expected' => 10,
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($args, $type)
	{
		try {
			Dash\apply(function () {}, $args);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\apply expects iterable or stdClass but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With null' => [
				'args' => null,
				'type' => 'NULL',
			],
			'With an empty string' => [
				'args' => '',
				'type' => 'string',
			],
			'With a string' => [
				'args' => 'hello',
				'type' => 'string',
			],
			'With a zero number' => [
				'args' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'args' => 3.14,
				'type' => 'double',
			],
			'With a DateTime' => [
				'args' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}

	public function testExamples()
	{
		$func = function ($time, $name) {
			return "Good $time, $name";
		};
		$this->assertSame('Good morning, John', Dash\apply($func, ['morning', 'John']));

		$func = function ($time, $name) {
			return "Good $time, $name";
		};
		$apply = Dash\Curry\apply($func);
		$this->assertSame('Good morning, John', $apply(['morning', 'John']));
	}
}
