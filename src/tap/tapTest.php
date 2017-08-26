<?php

/**
 * @covers Dash\tap
 */
class tapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input)
	{
		$passed = null;

		$output = Dash\tap($input, function ($passed) use ($input) {
			$this->assertSame($input, $passed);
			$passed = 'changed';
			return $passed;
		});

		$this->assertSame($input, $output);
	}

	public function cases()
	{
		return [
			[[1, 2, 3]],
			[(object) [1, 2, 3]],
			[null],
			[3.14],
			['hello'],
			[new DateTime()],
		];
	}
}
