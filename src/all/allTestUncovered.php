<?php

/**
 * These tests crash with code coverage, so they've been moved here.
 *
 * @codeCoverageIgnore
 * @codingStandardsIgnoreFile
 */
class allTestUncovered extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$this->assertEquals($expected, Dash\all($iterable, $predicate));
		$this->assertEquals($expected, Dash\every($iterable, $predicate));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $predicate, $expected)
	{
		$all = Dash\_all($predicate);
		$this->assertEquals($expected, $all($iterable));

		$every = Dash\_every($predicate);
		$this->assertEquals($expected, $every($iterable));
	}

	public function cases()
	{
		return [
			'With a DirectoryIterator with all items that satisfy the predicate' => [
				'iterable' => new \FilesystemIterator(
					__DIR__,
					\FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO
				),
				'predicate' => function ($fileinfo, $path) {
					return strpos($fileinfo->getFilename(), 'all') === 0;
				},
				'expected' => true,
			],
			'With a DirectoryIterator with no items that satisfy the predicate' => [
				'iterable' => new \FilesystemIterator(
					__DIR__,
					\FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO
				),
				'predicate' => function ($fileinfo, $path) {
					return strpos($fileinfo->getFilename(), 'nonexistent') === 0;
				},
				'expected' => false,
			],
		];
	}
}
