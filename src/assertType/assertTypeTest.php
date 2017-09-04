<?php

/**
 * @covers Dash\assertType
 * @covers Dash\_assertType
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

	/**
	 * @dataProvider cases
	 */
	public function testCurried($input, $type)
	{
		$assertType = Dash\_assertType($type, __FUNCTION__);
		$assertType($input);
	}

	public function cases()
	{
		return [
			'With a null type' => [
				'input' => 'hello',
				'type' => null,
			],
			'With an empty string type' => [
				'input' => 'hello',
				'type' => '',
			],
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
	 * @dataProvider casesException
	 */
	public function testException($input, $type, $expected)
	{
		try {
			Dash\assertType($input, $type);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (InvalidArgumentException $e) {
			$this->assertSame($expected, $e->getMessage());
		}

		try {
			$assertType = Dash\_assertType($type, 'Dash\assertType');
			$assertType($input);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (InvalidArgumentException $e) {
			$this->assertSame($expected, $e->getMessage());
		}
	}

	public function casesException()
	{
		return [
			'With a single type and scalar input' => [
				'input' => 42,
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given integer',
			],
			'With a single type and DateTime input' => [
				'input' => new DateTime(),
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given DateTime',
			],
			'With a single type and stdClass input' => [
				'input' => (object) [],
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given stdClass',
			],
			'With multiple types' => [
				'input' => 3.14,
				'type' => ['null', 'array', 'object'],
				'expected' => 'Dash\assertType expects null or array or object but was given double',
			],
		];
	}

	public function testExamples()
	{
		$input = [1, 2, 3];
		Dash\assertType($input, 'iterable');
		// Does not throw an exception

		try {
			$input = [1, 2, 3];
			Dash\assertType($input, 'object');
			$this->assertTrue(false, 'This should never be called');
		}
		catch (InvalidArgumentException $e) {
			$this->assertTrue(true);
		}
	}
}
