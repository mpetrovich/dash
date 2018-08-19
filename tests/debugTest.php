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
		$result = Dash\debug([1, 2, 3], 'hello', null);
		$output = ob_get_clean();

		$expectedOutput = <<<'END'
array (
  0 => 1,
  1 => 2,
  2 => 3,
)
'hello'
NULL

END;

		$this->assertSame([1, 2, 3], $result);
		$this->assertSame($expectedOutput, $output);
	}
}
