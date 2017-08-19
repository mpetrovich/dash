<?php

/**
 * @covers Dash\findValue
 */
class findValueTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\findValue($iterable, $predicate));
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'With an empty array' => [
				'input' => [],
				'predicate' => function () { return true; },
				'expected' => null,
			],
			'With a non-matching search of an array' => [
				'input' => [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function () { return false; },
				'expected' => null,
			],
			'With a matching value search of an array' => [
				'input' => [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function ($value) {
					return $value == 'green';
				},
				'expected' => 'green',
			],
			'With a matching key search of an array' => [
				'input' => [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function ($value, $key) {
					return $key == 'd';
				},
				'expected' => 'green',
			],
			'With a shorthand value search of an array' => [
				'input' => [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => 'blue',
				'expected' => 'blue',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'input' => (object) [],
				'predicate' => function () { return true; },
				'expected' => null,
			],
			'With a non-matching search of an stdClass' => [
				'input' => (object) [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function () { return false; },
				'expected' => null,
			],
			'With a matching value search of an stdClass' => [
				'input' => (object) [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function ($value) {
					return $value == 'green';
				},
				'expected' => 'green',
			],
			'With a matching key search of an stdClass' => [
				'input' => (object) [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => function ($value, $key) {
					return $key == 'd';
				},
				'expected' => 'green',
			],
			'With a shorthand value search of an stdClass' => [
				'input' => (object) [
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				],
				'predicate' => 'blue',
				'expected' => 'blue',
			],

			/*
				With ArrayObject
			 */

			'With an empty stdClass' => [
				'input' => new ArrayObject([]),
				'predicate' => function () { return true; },
				'expected' => null,
			],
			'With a non-matching search of an stdClass' => [
				'input' => new ArrayObject([
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				]),
				'predicate' => function () { return false; },
				'expected' => null,
			],
			'With a matching value search of an stdClass' => [
				'input' => new ArrayObject([
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				]),
				'predicate' => function ($value) {
					return $value == 'green';
				},
				'expected' => 'green',
			],
			'With a matching key search of an stdClass' => [
				'input' => new ArrayObject([
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				]),
				'predicate' => function ($value, $key) {
					return $key == 'd';
				},
				'expected' => 'green',
			],
			'With a shorthand value search of an ArrayObject' => [
				'input' => new ArrayObject([
					'a' => 'red',
					'b' => 'green',
					'c' => 'blue',
					'd' => 'green',
					'e' => 'yellow',
				]),
				'predicate' => 'blue',
				'expected' => 'blue',
			],
		];
	}
}
