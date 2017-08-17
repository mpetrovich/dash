<?php

/**
 * @covers Dash\getDirect
 */
class getDirectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $field, $default, $expected)
	{
		$this->assertEquals($expected, Dash\getDirect($input, $field, $default));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'field' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a string' => [
				'input' => 'hello',
				'field' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an empty array' => [
				'input' => [],
				'field' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an array' => [
				'input' => ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'field' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With a non-empty stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'field' => 'b',
				'default' => 'default',
				'expected' => 'default',
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'field' => 'b',
				'default' => 'default',
				'expected' => 2,
			],
		];
	}
}
