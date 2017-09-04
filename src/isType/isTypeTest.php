<?php

/**
 * @covers Dash\isType
 */
class isTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $type, $expected)
	{
		$this->assertSame($expected, Dash\isType($input, $type));
	}

	public function cases()
	{
		return [

			/*
				With one type
			 */

			'With one type and null' => [
				'input' => null,
				'type' => 'null',
				'expected' => true,
			],

			'With one type and an integer' => [
				'input' => 42,
				'type' => 'integer',
				'expected' => true,
			],
			'With one type and an integer' => [
				'input' => 42,
				'type' => 'double',
				'expected' => false,
			],
			'With one type and an integer' => [
				'input' => 42,
				'type' => 'scalar',
				'expected' => true,
			],

			'With one type and a double' => [
				'input' => 3.14,
				'type' => 'double',
				'expected' => true,
			],
			'With one type and a double' => [
				'input' => 3.14,
				'type' => 'scalar',
				'expected' => true,
			],

			'With one type and a string' => [
				'input' => 'hello',
				'type' => 'string',
				'expected' => true,
			],
			'With one type and a string' => [
				'input' => 'hello',
				'type' => 'scalar',
				'expected' => true,
			],

			'With one type and an array' => [
				'input' => [1, 2, 3],
				'type' => 'array',
				'expected' => true,
			],
			'With one type and an array' => [
				'input' => [1, 2, 3],
				'type' => 'iterable',
				'expected' => true,
			],

			'With one type and an object' => [
				'input' => (object) [1, 2, 3],
				'type' => 'object',
				'expected' => true,
			],
			'With one type and an object' => [
				'input' => (object) [1, 2, 3],
				'type' => 'iterable',
				'expected' => true,
			],

			'With one type and an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => 'object',
				'expected' => true,
			],
			'With one type and an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => 'iterable',
				'expected' => true,
			],
			'With one type and an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => 'ArrayObject',
				'expected' => true,
			],

			'With one type and a DirectoryIterator' => [
				'input' => new FilesystemIterator(
					__DIR__,
					FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO
				),
				'type' => 'iterable',
				'expected' => true,
			],

			/*
				With several types
			 */

			'With several types with null' => [
				'input' => null,
				'type' => ['integer', 'null'],
				'expected' => true,
			],

			'With several types with an integer' => [
				'input' => 42,
				'type' => ['string', 'integer'],
				'expected' => true,
			],
			'With several types with an integer' => [
				'input' => 42,
				'type' => ['string', 'double'],
				'expected' => false,
			],
			'With several types with an integer' => [
				'input' => 42,
				'type' => ['double', 'scalar'],
				'expected' => true,
			],

			'With several types with a double' => [
				'input' => 3.14,
				'type' => ['double', 'string'],
				'expected' => true,
			],
			'With several types with a double' => [
				'input' => 3.14,
				'type' => ['integer', 'scalar'],
				'expected' => true,
			],

			'With several types with a string' => [
				'input' => 'hello',
				'type' => ['integer', 'string'],
				'expected' => true,
			],
			'With several types with a string' => [
				'input' => 'hello',
				'type' => ['object', 'scalar'],
				'expected' => true,
			],

			'With several types with an array' => [
				'input' => [1, 2, 3],
				'type' => ['object', 'array'],
				'expected' => true,
			],

			'With several types with an object' => [
				'input' => (object) [1, 2, 3],
				'type' => ['array', 'iterable'],
				'expected' => true,
			],

			'With several types with an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => ['object', 'array'],
				'expected' => true,
			],

			'With several types with an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => ['iterable'],
				'expected' => true,
			],
		];
	}
}
