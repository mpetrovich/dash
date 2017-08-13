<?php

class assertTypeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesNoException
	 */
	public function testNoException($input, $type)
	{
		Dash\assertType($input, $type);
	}

	public function casesNoException()
	{
		return [

			/*
				With one type
			 */

			'Asserting with one type and null' => [
				'input' => null,
				'type' => 'null',
			],

			'Asserting with one type and an integer' => [
				'input' => 42,
				'type' => 'integer',
			],
			'Asserting with one type and an integer' => [
				'input' => 42,
				'type' => 'scalar',
			],

			'Asserting with one type and a double' => [
				'input' => 3.14,
				'type' => 'double',
			],
			'Asserting with one type and a double' => [
				'input' => 3.14,
				'type' => 'scalar',
			],

			'Asserting with one type and a string' => [
				'input' => 'hello',
				'type' => 'string',
			],
			'Asserting with one type and a string' => [
				'input' => 'hello',
				'type' => 'scalar',
			],

			'Asserting with one type and an array' => [
				'input' => [1, 2, 3],
				'type' => 'array',
			],

			'Asserting with one type and an object' => [
				'input' => (object) [1, 2, 3],
				'type' => 'object',
			],

			'Asserting with one type and an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => 'object',
			],

			/*
				With several types
			 */

			'Asserting with several types with null' => [
				'input' => null,
				'type' => ['integer', 'null'],
			],

			'Asserting with several types with an integer' => [
				'input' => 42,
				'type' => ['string', 'integer'],
			],
			'Asserting with several types with an integer' => [
				'input' => 42,
				'type' => ['double', 'scalar'],
			],

			'Asserting with several types with a double' => [
				'input' => 3.14,
				'type' => ['double', 'string'],
			],
			'Asserting with several types with a double' => [
				'input' => 3.14,
				'type' => ['integer', 'scalar'],
			],

			'Asserting with several types with a string' => [
				'input' => 'hello',
				'type' => ['integer', 'string'],
			],
			'Asserting with several types with a string' => [
				'input' => 'hello',
				'type' => ['object', 'scalar'],
			],

			'Asserting with several types with an array' => [
				'input' => [1, 2, 3],
				'type' => ['object', 'array'],
			],

			'Asserting with several types with an object' => [
				'input' => (object) [1, 2, 3],
				'type' => ['array', 'object'],
			],

			'Asserting with several types with an ArrayObject' => [
				'input' => new ArrayObject([1, 2, 3]),
				'type' => ['object', 'array'],
			],
		];
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Expected string but was given integer
	 */
	public function testExceptionWithOneType()
	{
		Dash\assertType(42, 'string');
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Expected null or array or object but was given double
	 */
	public function testExceptionWithSeveralTypes()
	{
		Dash\assertType(3.14, ['null', 'array', 'object']);
	}
}
