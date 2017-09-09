<?php

/**
 * @covers Dash\toArray
 * @covers Dash\_toArray
 */
class toArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value, $expected)
	{
		$this->assertSame($expected, Dash\toArray($value));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value, $expected)
	{
		$toArray = Dash\_toArray();
		$this->assertSame($expected, $toArray($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
				'expected' => [],
			],
			'With a string' => [
				'value' => 'hello',
				'expected' => ['hello'],
			],
			'With a number' => [
				'value' => 3.14,
				'expected' => [3.14],
			],
			'With a DateTime' => [
				'value' => new DateTime('@0'),
				'expected' => [
					'date' => '1970-01-01 00:00:00.000000',
					'timezone_type' => 1,
					'timezone' => '+00:00',
				],
			],

			/*
				With array
			 */

			'With an empty array' => [
				'value' => [],
				'expected' => [],
			],
			'With an indexed array' => [
				'value' => [3, 8, 2, 5],
				'expected' => [3, 8, 2, 5],
			],
			'With an associative array' => [
				'value' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'expected' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'value' => (object) [],
				'expected' => [],
			],
			'With an stdClass of an indexed array' => [
				'value' => (object) [3, 8, 2, 5],
				'expected' => [3, 8, 2, 5],
			],
			'With an stdClass of an associative array' => [
				'value' => (object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				'expected' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'value' => new ArrayObject([]),
				'expected' => [],
			],
			'With an ArrayObject of an indexed array' => [
				'value' => new ArrayObject([3, 8, 2, 5]),
				'expected' => [3, 8, 2, 5],
			],
			'With an ArrayObject of an associative array' => [
				'value' => new ArrayObject(['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5]),
				'expected' => ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
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

	public function testExamples()
	{
		$this->assertSame(['a' => 1, 'b' => 2], Dash\toArray((object) ['a' => 1, 'b' => 2]));
		$this->assertCount(2, Dash\toArray(new FilesystemIterator(__DIR__)));
	}
}
