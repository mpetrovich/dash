<?php

/**
 * @covers Dash\identity
 * @covers Dash\_identity
 */
class identityTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\identity($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$identity = Dash\_identity();
		$this->assertSame($expected, $identity($value));
	}

	public function cases()
	{
		$date = new DateTime();
		$arrayObject = new ArrayObject([1, 2, 3]);
		$stdClass = (object) ['a' => 1, 'b' => 2, 'c' => 3];

		return [
			'With null' => [
				'value' => null,
				'expected' => null,
			],
			'With a double' => [
				'value' => 3.14,
				'expected' => 3.14,
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => 'hello',
			],
			'With a DateTime' => [
				'value' => $date,
				'expected' => $date,
			],
			'With an empty array' => [
				'value' => [],
				'expected' => [],
			],
			'With an array' => [
				'value' => ['a' => 1, 'b' => 2, 'c' => 3],
				'expected' => ['a' => 1, 'b' => 2, 'c' => 3],
			],
			'With an stdClass' => [
				'value' => $stdClass,
				'expected' => $stdClass,
			],
			'With an ArrayObject' => [
				'value' => $arrayObject,
				'expected' => $arrayObject,
			],
		];
	}

	public function testExamples()
	{
		$a = new ArrayObject();
		$b = Dash\identity($a);
		$this->assertSame($a, $b);
	}
}
