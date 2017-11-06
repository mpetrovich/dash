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
		Dash\debug($value);
		$output = ob_get_clean();

		$this->assertMatch($expected, $output);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		ob_start();
		$debug = Dash\_debug();
		$debug($value);
		$output = ob_get_clean();

		$this->assertMatch($expected, $output);
	}

	public function cases()
	{
		return [
			[
				'value' => [1, 2, 3],
				'expected' => <<<'END'
# IGNORED LINE
array(3) {
  [0] =>
  int(1)
  [1] =>
  int(2)
  [2] =>
  int(3)
}
END
			],
			[
				'value' => 3.14,
				'expected' => <<<'END'
# IGNORED LINE
double(3.14)
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
# IGNORED LINE
array(3) {
  [0] =>
  int(1)
  [1] =>
  int(2)
  [2] =>
  int(3)
}
# IGNORED LINE
string(5) "hello"
# IGNORED LINE
double(3.14)
END;

		$this->assertMatch($expected, $output);
	}

	private function assertMatch($expected, $actual)
	{
		$this->assertTrue($this->isMatch($expected, $actual));
	}

	private function isMatch($expected, $actual)
	{
		$expectedLines = explode("\n", trim($expected));
		$actualLines = explode("\n", trim($actual));
		$numLines = count($actualLines);

		if (count($expectedLines) !== $numLines) {
			return false;
		}

		for ($i = 0; $i < $numLines; $i++) {
			$actualLine = $actualLines[$i];
			$expectedLine = $expectedLines[$i];

			if ($expectedLine === '# IGNORED LINE') {
				continue;
			}
			if ($actualLine !== $expectedLine) {
				return false;
			}
		}

		return true;
	}
}
