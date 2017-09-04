<?php

/**
 * @covers Dash\values
 */
class valuesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		$this->assertSame($expected, Dash\values($input));
	}

	public function cases()
	{
		return [
			'With null' => [
				'input' => null,
				'expected' => [],
			],
			'With an empty array' => [
				'input' => [],
				'expected' => [],
			],
			'With an array' => [
				'input' => [],
				'expected' => [],
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'expected' => [],
			],
			'With a stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => [1, 2, 3],
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'expected' => [1, 2, 3],
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				'expected' => [1, 2, 3],
			],
		];
	}
}
