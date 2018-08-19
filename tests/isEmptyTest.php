<?php

/**
 * @covers Dash\isEmpty
 * @covers Dash\_isEmpty
 */
class isEmptyTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		$this->assertSame($expected, Dash\isEmpty($input));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$isEmpty = Dash\_isEmpty();
		$this->assertSame($expected, $isEmpty($value));
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
			'With a number' => [
				'input' => 3.14,
				'expected' => false,
			],
			'With an empty string' => [
				'input' => '',
				'expected' => true,
			],
			'With a string' => [
				'input' => 'hello',
				'expected' => false,
			],
			'With an empty array' => [
				'input' => [],
				'expected' => true,
			],
			'With an array' => [
				'input' => [1, 2, 3],
				'expected' => false,
			],
			'With an empty stdClass' => [
				'input' => (object) [],
				'expected' => true,
			],
			'With an stdClass' => [
				'input' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'expected' => true,
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]),
				'expected' => false,
			],
			'With an DirectoryIterator' => [
				'input' => new \FilesystemIterator(__DIR__),
				'expected' => false,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\isEmpty([]));
		$this->assertSame(true, Dash\isEmpty((object) []));
		$this->assertSame(true, Dash\isEmpty(new ArrayObject()));
		$this->assertSame(true, Dash\isEmpty(''));
		$this->assertSame(true, Dash\isEmpty(0));
		$this->assertSame(false, Dash\isEmpty([0]));
	}
}
