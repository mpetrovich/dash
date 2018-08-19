<?php

/**
 * @covers Dash\debug
 * @covers Dash\_debug
 */
class debugTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		ob_start();
		$result = Dash\debug($value);
		ob_clean();

		$this->assertSame($expected, $result);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		ob_start();
		$debug = Dash\_debug();
		$result = $debug($value);
		ob_clean();

		$this->assertSame($expected, $result);
	}

	public function cases()
	{
		return [
			[
				'value' => [1, 2, 3],
				'expected' => [1, 2, 3],
			],
			[
				'value' => 3.14,
				'expected' => 3.14,
			],
		];
	}

	public function testMultipleValues()
	{
		ob_start();
		$result = Dash\debug([1, 2, 3], 'hello', 3.14);
		ob_clean();

		$expected = [1, 2, 3];

		$this->assertSame($expected, $result);
	}
}
