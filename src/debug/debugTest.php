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
		$output = ob_get_clean();

		$this->assertSame(trim($expected), trim($output));
		$this->assertSame($value, $result);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		ob_start();
		$debug = Dash\_debug();
		$result = $debug($value);
		$output = ob_get_clean();

		$this->assertSame(trim($expected), trim($output));
		$this->assertSame($value, $result);
	}

	public function cases()
	{
		return [
			[
				'value' => [1, 2, 3],
				'expected' => <<<'END'
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}
END
			],
			[
				'value' => 3.14,
				'expected' => <<<'END'
float(3.14)
END
			],
		];
	}

	public function testMultipleValues()
	{
		ob_start();
		Dash\debug([1, 2, 3], 'hello', 3.14);
		$output = ob_get_clean();

		$expected = <<<'END'
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}
string(5) "hello"
float(3.14)
END;

		$this->assertSame(trim($expected), trim($output));
	}
}
