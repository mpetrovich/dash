<?php

/**
 * @covers Dash\getDirectRef
 */
class getDirectRefTest extends PHPUnit_Framework_TestCase
{
	public function testArray()
	{
		$subject = ['key' => 'value'];
		$ref = Dash\getDirectRef($subject, 'key');
		$this->assertSame($subject['key'], $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should be changed');
	}

	public function testObject()
	{
		$subject = (object) ['key' => 'value'];
		$ref = Dash\getDirectRef($subject, 'key');
		$this->assertSame($subject->key, $ref, 'A reference is returned');

		$ref = 'changed';
		$this->assertSame('changed', $ref, 'The original value should be updated');
	}

	/**
	 * @dataProvider casesInvalid
	 * @expectedException \UnexpectedValueException
	 */
	public function testInvalid($subject)
	{
		$ref = Dash\getDirectRef($subject, 'key');
	}

	public function casesInvalid()
	{
		return [
			[null],
			[123],
			[3.14],
			['hello'],
			[new \DateTime()],
		];
	}
}
