<?php

/**
 * @covers Dash\last
 */
class lastTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\last($iterable));
	}

	public function cases()
	{
		return [
			'With an empty array' => [
				[],
				null,
			],
			'With an array' => [
				['a', 'b', 'c'],
				'c',
			],
			'With an array with null as the last element' => [
				['a', 'b', null],
				null,
			],
			'With an ArrayObject' => [
				new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
				3,
			],
			'With a DirectoryIterator' => [
				new FilesystemIterator(__DIR__, FilesystemIterator::CURRENT_AS_PATHNAME),
				__DIR__ . '/lastTest.php',
			],
		];
	}
}
