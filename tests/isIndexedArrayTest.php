<?php

/**
 * @covers Dash\isIndexedArray
 * @covers Dash\Curry\isIndexedArray
 */
class isIndexedArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\isIndexedArray($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isIndexedArray = Dash\Curry\isIndexedArray();
		$this->assertSame($expected, $isIndexedArray($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
				'expected' => false,
			],
			'With a number' => [
				'value' => 123,
				'expected' => false,
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => false,
			],
			'With an empty array' => [
				'value' => [],
				'expected' => true,
			],
			'With an indexed array' => [
				'value' => ['a', 'b', 'c'],
				'expected' => true,
			],
			'With an explicitly indexed array' => [
				'value' => [0 => 'a', 1 => 'b', 2 => 'c'],
				'expected' => true,
			],
			'With an indexed array with keys starting at 1' => [
				'value' => [1 => 'a', 'b', 'c'],
				'expected' => false,
			],
			'With an explicitly indexed array with keys out of order' => [
				'value' => [1 => 'b', 0 => 'a', 2 => 'c'],
				'expected' => false,
			],
			'With an associative array with integer-like string keys' => [
				'value' => ['0' => 'a', '1' => 'b', '2' => 'c'],
				'expected' => true,
			],
			'With an associative array with mixed integer-like keys in sequential order starting at 0' => [
				'value' => [false => 'a', true => 'b', '2' => 'c'],
				'expected' => true,
			],
			'With an associative array with mixed integer-like keys in sequential order starting at 1' => [
				'value' => [true => 'a', 2 => 'b', '3' => 'c'],
				'expected' => false,
			],
			'With an associative array' => [
				'value' => ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => false,
			],
			'With an empty stdClass' => [
				'value' => (object) [],
				'expected' => false,
			],
			'With an stdClass with string keys' => [
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => false,
			],
			'With an stdClass with integer keys' => [
				'value' => (object) ['a', 'b', 'c'],
				'expected' => false,
			],
			'With an ArrayObject with string keys' => [
				'value' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'expected' => false,
			],
			'With an ArrayObject with integer keys' => [
				'value' => new ArrayObject(['a', 'b', 'c']),
				'expected' => false,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\isIndexedArray(['a', 'b', 'c']));
		$this->assertSame(false, Dash\isIndexedArray([1 => 'a', 'b', 'c']));
		$this->assertSame(false, Dash\isIndexedArray(['a' => 1, 'b' => 2]));
	}
}
