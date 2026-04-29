<?php

/**
 * @covers Dash\typeOf
 * @covers Dash\Curry\typeOf
 */
class typeOfTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\typeOf($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$typeOf = Dash\Curry\typeOf();
		$this->assertSame($expected, $typeOf($value));
	}

	public function cases()
	{
		return [
			[null, 'NULL'],
			[1, 'integer'],
			[3.14, 'double'],
			['a', 'string'],
			[[], 'array'],
			[(object) [], 'stdClass'],
			[new ArrayObject([]), 'ArrayObject'],
		];
	}
}
