<?php

/**
 * @covers Dash\getDirectRef
 * @covers Dash\_getDirectRef
 */
class getDirectRefTest extends PHPUnit_Framework_TestCase
{
	public function testArray()
	{
		$subject = ['key' => null];
		$ref = Dash\getDirectRef($subject, 'key');
		$this->assertSame($subject['key'], $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should be changed');
	}

	public function testObject()
	{
		$subject = (object) ['key' => null];
		$ref = Dash\getDirectRef($subject, 'key');
		$this->assertSame($subject->key, $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should have changed');
	}

	public function testArrayObject()
	{
		$subject = new ArrayObject(['key' => null]);
		$ref = Dash\getDirectRef($subject, 'key');
		$this->assertSame($subject['key'], $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should be changed');
	}

	public function testArrayCurried()
	{
		$subject = ['key' => null];
		$getDirectRef = Dash\_getDirectRef('key');
		$ref = $getDirectRef($subject);
		$this->assertSame($subject['key'], $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should have changed');
	}

	public function testObjectCurried()
	{
		$subject = (object) ['key' => null];
		$getDirectRef = Dash\_getDirectRef('key');
		$ref = $getDirectRef($subject);
		$this->assertSame($subject->key, $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should have changed');
	}

	public function testArrayObjectCurried()
	{
		$subject = new ArrayObject(['key' => null]);
		$getDirectRef = Dash\_getDirectRef('key');
		$ref = $getDirectRef($subject);
		$this->assertSame($subject['key'], $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should have changed');
	}

	/**
	 * @dataProvider casesNoMatchingField
	 * @expectedException UnexpectedValueException
	 */
	public function testNoMatchingField($input, $key, $message)
	{
		try {
			Dash\getDirectRef($input, $key);
		}
		catch (Exception $e) {
			$this->assertSame($message, $e->getMessage());
			throw $e;
		}
	}

	public function casesNoMatchingField()
	{
		return [
			'With null' => [
				'input' => null,
				'key' => 'foo',
				'message' => 'NULL has no property "foo"',
			],
			'With an empty string' => [
				'input' => '',
				'key' => 'foo',
				'message' => 'string has no property "foo"',
			],
			'With a string' => [
				'input' => 'hello',
				'key' => 'foo',
				'message' => 'string has no property "foo"',
			],
			'With a zero number' => [
				'input' => 0,
				'key' => 'foo',
				'message' => 'integer has no property "foo"',
			],
			'With a number' => [
				'input' => 3.14,
				'key' => 'foo',
				'message' => 'double has no property "foo"',
			],

			/*
				With array
			 */

			'With an empty array' => [
				'input' => [],
				'key' => 'foo',
				'message' => 'array has no property "foo"',
			],
			'With an array' => [
				'input' => ['bar' => 123],
				'key' => 'foo',
				'message' => 'array has no property "foo"',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'input' => (object) [],
				'key' => 'foo',
				'message' => 'stdClass has no property "foo"',
			],
			'With an stdClass' => [
				'input' => (object) ['bar' => 123],
				'key' => 'foo',
				'message' => 'stdClass has no property "foo"',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'key' => 'foo',
				'message' => 'ArrayObject has no property "foo"',
			],
			'With an ArrayObject' => [
				'input' => new ArrayObject(['bar' => 123]),
				'key' => 'foo',
				'message' => 'ArrayObject has no property "foo"',
			],
		];
	}

	public function testExamples()
	{
		$array = ['key' => 'value'];
		$ref = &Dash\getDirectRef($array, 'key');
		$ref = 'changed';
		$this->assertSame('changed', $array['key']);

		$object = (object) ['key' => 'value'];
		$ref = &Dash\getDirectRef($object, 'key');
		$ref = 'changed';
		$this->assertSame('changed', $object->key);
	}
}
