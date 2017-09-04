<?php

/**
 * @covers Dash\toArray
 */
class toArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertSame($expected, Dash\toArray($iterable));
	}

	public function cases()
	{
		return [

			'With null' => [
				'hello',
				['hello'],
			],
			'With a string' => [
				null,
				[],
			],

			/*
				With array
			 */

			'With an empty array' => [
				[],
				[],
			],
			'With an indexed array' => [
				[3, 8, 2, 5],
				[3, 8, 2, 5],
			],
			'With an associative array' => [
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				(object) [],
				[],
			],
			'With a stdClass' => [
				(object) [3, 8, 2, 5],
				[3, 8, 2, 5],
			],
			'With an associative array' => [
				(object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				new ArrayObject([]),
				[],
			],
			'With an indexed ArrayObject' => [
				new ArrayObject([3, 8, 2, 5]),
				[3, 8, 2, 5],
			],
			'With an associative ArrayObject' => [
				new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],
		];
	}

	public function testDirectoryIterator()
	{
		$input = new \FilesystemIterator(
			__DIR__,
			\FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::CURRENT_AS_FILEINFO
		);
		$output = Dash\toArray($input);

		$this->assertCount(2, $output);

		$i = 0;
		$prevValue = null;

		foreach ($output as $key => $value) {
			if ($i === 0) {
				$this->assertStringEndsWith('toArray.php', $key);
			}
			elseif ($i === 1) {
				$this->assertStringEndsWith('toArrayTest.php', $key);
			}

			$this->assertInstanceOf('SplFileInfo', $value);
			$this->assertNotSame($prevValue, $value);

			$prevValue = $value;
			$i++;
		}
	}
}
