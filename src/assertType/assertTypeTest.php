<?php

/**
 * @covers Dash\assertType
 */
class assertTypeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $type)
	{
		Dash\assertType($input, $type);
	}

	public function cases()
	{
		return [
			'With one type' => [
				'input' => 'hello',
				'type' => 'string',
			],
			'With several types' => [
				'input' => [1, 2, 3],
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
