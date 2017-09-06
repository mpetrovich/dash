<?php

/**
 * @covers Dash\isType
 * @covers Dash\_isType
 */
class isTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $type, $expected)
	{
		$this->assertSame($expected, Dash\isType($value, $type));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $type)
	{
		$isType = Dash\_isType($type);
		$isType($value);
	}

	public function cases()
	{
		return [

			/*
				With no type
			 */

			[
				'value' => null,
				'type' => false,
				'expected' => true,
			],
			[
				'value' => null,
				'type' => null,
				'expected' => true,
			],

			/*
				With one type
			 */

			[
				'value' => null,
				'type' => 'null',
				'expected' => true,
			],
			[
				'value' => false,
				'type' => 'null',
				'expected' => false,
			],
			[
				'value' => 42,
				'type' => 'integer',
				'expected' => true,
			],
			[
				'value' => 42,
				'type' => 'double',
				'expected' => false,
			],
			[
				'value' => 42,
				'type' => 'scalar',
				'expected' => true,
			],
			[
				'value' => 3.14,
				'type' => 'double',
				'expected' => true,
			],
			[
				'value' => 3.14,
				'type' => 'integer',
				'expected' => false,
			],
			[
				'value' => 3.14,
				'type' => 'scalar',
				'expected' => true,
			],
			[
				'value' => 'hello',
				'type' => 'string',
				'expected' => true,
			],
			[
				'value' => 'hello',
				'type' => 'scalar',
				'expected' => true,
			],
			[
				'value' => [1, 2, 3],
				'type' => 'array',
				'expected' => true,
			],
			[
				'value' => [1, 2, 3],
				'type' => 'iterable',
				'expected' => true,
			],
			[
				'value' => (object) [1, 2, 3],
				'type' => 'object',
				'expected' => true,
			],
			[
				'value' => (object) [1, 2, 3],
				'type' => 'iterable',
				'expected' => false,
			],
			[
				'value' => new ArrayObject([1, 2, 3]),
				'type' => 'object',
				'expected' => true,
			],
			[
				'value' => new ArrayObject([1, 2, 3]),
				'type' => 'iterable',
				'expected' => true,
			],
			[
				'value' => new ArrayObject([1, 2, 3]),
				'type' => 'ArrayObject',
				'expected' => true,
			],
			[
				'value' => new FilesystemIterator(
					__DIR__,
					FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO
				),
				'type' => 'iterable',
				'expected' => true,
			],

			/*
				With several types
			 */

			[
				'value' => null,
				'type' => ['integer', 'null'],
				'expected' => true,
			],
			[
				'value' => false,
				'type' => ['integer', 'null'],
				'expected' => false,
			],
			[
				'value' => 42,
				'type' => ['string', 'integer'],
				'expected' => true,
			],
			[
				'value' => 42,
				'type' => ['string', 'double'],
				'expected' => false,
			],
			[
				'value' => 42,
				'type' => ['double', 'scalar'],
				'expected' => true,
			],
			[
				'value' => 3.14,
				'type' => ['double', 'string'],
				'expected' => true,
			],
			[
				'value' => 3.14,
				'type' => ['integer', 'scalar'],
				'expected' => true,
			],
			[
				'value' => 'hello',
				'type' => ['integer', 'string'],
				'expected' => true,
			],
			[
				'value' => 'hello',
				'type' => ['object', 'scalar'],
				'expected' => true,
			],
			[
				'value' => [1, 2, 3],
				'type' => ['object', 'array'],
				'expected' => true,
			],
			[
				'value' => (object) [1, 2, 3],
				'type' => ['array', 'iterable'],
				'expected' => false,
			],
			[
				'value' => (object) [1, 2, 3],
				'type' => ['stdClass', 'iterable'],
				'expected' => true,
			],
			[
				'value' => new ArrayObject([1, 2, 3]),
				'type' => ['object', 'array'],
				'expected' => true,
			],
			[
				'value' => new ArrayObject([1, 2, 3]),
				'type' => ['iterable'],
				'expected' => true,
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(true, Dash\isType([1, 2, 3], 'array'));
		$this->assertSame(true, Dash\isType(3.14, 'numeric'));
		$this->assertSame(true, Dash\isType(new ArrayObject([1, 2, 3]), 'ArrayObject'));
		$this->assertSame(true, Dash\isType((object) [1, 2, 3], ['array', 'object']));
	}
}
