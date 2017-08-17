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
		$actual = Dash\toArray($iterable);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return [

			/*
				With array
			 */

			'should return an empty array for an empty array' => [
				[],
				[],
			],
			'should return an array of the values of an indexed array' => array(
				[3, 8, 2, 5],
				[3, 8, 2, 5],
			),
			'should return an array of the values of an associative array' => array(
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			),

			/*
				With stdClass
			 */

			'should return an empty array for an empty stdClass' => array(
				(object) [],
				[],
			),
			'should return an array of the values of a stdClass' => array(
				(object) [3, 8, 2, 5],
				[3, 8, 2, 5],
			),
			'should return an array of the values of an associative array' => array(
				(object) ['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			),

			/*
				With ArrayObject
			 */

			'should return an empty array for an empty ArrayObject' => array(
				new ArrayObject([]),
				[],
			),
			'should return an array of the values of an indexed ArrayObject' => array(
				new ArrayObject(array(3, 8, 2, 5)),
				[3, 8, 2, 5],
			),
			'should return an array of the values of an associative ArrayObject' => array(
				new ArrayObject(array('a' => 3, 'b' => 8, 'c' => 2, 'd' => 5)),
				['a' => 3, 'b' => 8, 'c' => 2, 'd' => 5],
			),
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
