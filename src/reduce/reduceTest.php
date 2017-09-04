<?php

/**
 * @covers Dash\reduce
 */
class reduceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $iteratee, $initial, $expected)
	{
		$this->assertSame($expected, Dash\reduce($input, $iteratee, $initial));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				'input' => [],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With an array' => [
				'input' => [1, 2, 3, 4],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With a non-empty stdClass' => [
				'input' => (object) [1, 2, 3, 4],
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 0,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3, 4]),
				'iteratee' => function ($result, $value) { return $result + $value; },
				'initial' => 0,
				'expected' => 10,
			],
		];
	}
}
