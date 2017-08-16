<?php

/**
 * @covers Dash\isEmpty
 */
class isEmptyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		$this->assertEquals($expected, Dash\isEmpty($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'expected' => true,
			],
			'With a zero number' => [
				'input' => 0.0,
				'expected' => true,
			],
			'With a non-zero number' => [
				'input' => 3.14,
				'expected' => false,
			],
			'With an empty string' => [
				'input' => '',
				'expected' => true,
			],
			'With a non-empty string' => [
				'input' => 'hello',
				'expected' => false,
			],
			'With an empty array' => [
				'input' => [],
				'expected' => true,
			],
			'With a non-empty array' => [
				'input' => [1, 2, 3],
				'expected' => false,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'expected' => true,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'expected' => true,
			],
			'With a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'expected' => false,
			],
		];
	}
}
