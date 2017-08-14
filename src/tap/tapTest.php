<?php

class tapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input)
	{
		$passed = null;

		$output = Dash\tap($input, function($input) use (&$passed) {
			$passed = $input;
		});

		$this->assertSame($input, $output);
		$this->assertSame($input, $passed);
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

