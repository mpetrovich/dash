<?php

/**
 * @covers Dash\assertType
 * @covers Dash\Curry\assertType
 */
class assertTypeTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider casesWithoutException
	 */
	public function test($value, $type)
	{
		$this->assertNull(Dash\assertType($value, $type));
	}

	/**
	 * @dataProvider casesWithoutException
	 */
	public function testCurried($value, $type)
	{
		$assertType = Dash\Curry\assertType($type, __FUNCTION__);
		$this->assertNull($assertType($value));
	}

	public function casesWithoutException()
	{
		return [
			'With a null type' => [
				'value' => 'hello',
				'type' => null,
			],
			'With an empty string type' => [
				'value' => 'hello',
				'type' => '',
			],
			'With one type' => [
				'value' => 'hello',
				'type' => 'string',
			],
			'With several types' => [
				'value' => [1, 2, 3],
				'type' => ['object', 'array'],
			],
		];
	}

	/**
	 * @dataProvider casesWithException
	 */
	public function testException($value, $type, $expected)
	{
		try {
			Dash\assertType($value, $type);
			$this->assertTrue(false, 'This should never be called');
		} catch (InvalidArgumentException $e) {
			$this->assertSame($expected, $e->getMessage());
		}

		try {
			$assertType = Dash\Curry\assertType($type, 'Dash\assertType');
			$assertType($value);
			$this->assertTrue(false, 'This should never be called');
		} catch (InvalidArgumentException $e) {
			$this->assertSame($expected, $e->getMessage());
		}
	}

	public function casesWithException()
	{
		return [
			'With a single type and scalar value' => [
				'value' => 42,
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given integer',
			],
			'With a single type and DateTime value' => [
				'value' => new DateTime(),
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given DateTime',
			],
			'With a single type and stdClass value' => [
				'value' => (object) [],
				'type' => 'string',
				'expected' => 'Dash\assertType expects string but was given stdClass',
			],
			'With multiple types' => [
				'value' => 3.14,
				'type' => ['null', 'array', 'object'],
				'expected' => 'Dash\assertType expects null or array or object but was given double',
			],
		];
	}

	public function testExamples()
	{
		$value = [1, 2, 3];
		Dash\assertType($value, ['iterable', 'stdClass']);
		// Does not throw an exception

		try {
			$value = [1, 2, 3];
			Dash\assertType($value, 'object');
			$this->assertTrue(false, 'This should never be called');
		} catch (InvalidArgumentException $e) {
			$this->assertTrue(true);
		}
	}
}
