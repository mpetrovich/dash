<?php

/**
 * @covers Dash\hasDirect
 */
class hasDirectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $field, $expected)
	{
		$this->assertEquals($expected, Dash\hasDirect($input, $field));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'field' => 'foo',
				'expected' => false,
			],
			'With a number' => [
				'input' => 123.45,
				'field' => 'foo',
				'expected' => false,
			],
			'With a string' => [
				'input' => 'hello',
				'field' => 'foo',
				'expected' => false,
			],
			'With an non-stdClass object' => [
				'input' => new DateTime(),
				'field' => 'getTimestamp',
				'expected' => false,
			],
			'With an empty array' => [
				'input' => [],
				'field' => 0,
				'expected' => false,
			],
			'With an indexed array' => [
				'input' => [2, 3, 5, 8],
				'field' => 2,
				'expected' => true,
			],
			'With an associative array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'expected' => true,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'field' => 'b',
				'expected' => false,
			],
			'With an stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'expected' => true,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'field' => 'b',
				'expected' => false,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'field' => 'b',
				'expected' => true,
			],
		];
	}
}
