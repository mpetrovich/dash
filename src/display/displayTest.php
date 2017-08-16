<?php

/**
 * @covers Dash\display
 */
class displayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $expected)
	{
		ob_start();
		Dash\display($input);
		$output = ob_get_clean();

		$this->assertEquals(trim($expected), trim($output));
	}

	public function cases()
	{
		return [
			[
				'input' => [1, 2, 3],
				'expected' => <<<END
Array
(
    [0] => 1
    [1] => 2
    [2] => 3
)
END
			],
			[
				'input' => (object) [1, 2, 3],
				'expected' => <<<END
stdClass Object
(
    [0] => 1
    [1] => 2
    [2] => 3
)
END
			],
			[
				'input' => 3.14,
				'expected' => '3.14'
			],
		];
	}
}
