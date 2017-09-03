<?php

/**
 * @covers Dash\tap
 * @covers Dash\_tap
 */
class tapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value)
	{
		$passed = null;

		$result = Dash\tap($value, function ($passed) use ($value) {
			$this->assertSame($value, $passed);
			$passed = 'changed';
			return $passed;
		});

		$this->assertSame($value, $result);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value)
	{
		$passed = null;

		$tap = Dash\_tap(function ($passed) use ($value) {
			$this->assertSame($value, $passed);
			$passed = 'changed';
			return $passed;
		});

		$this->assertSame($value, $tap($value));
	}

	public function cases()
	{
		return [
			'With null' => [
				'value' => null,
			],
			'With a number' => [
				'value' => 3.14,
			],
			'With a string' => [
				'value' => 'hello',
			],
			'With a DateTime' => [
				'value' => new DateTime(),
			],
			'With an empty array' => [
				'value' => [],
			],
			'With an indexed array' => [
				'value' => [1, 2, 3],
			],
			'With an associative array' => [
				'value' => ['a' => 1, 'b' => 2, 'c' => 3],
			],
			'With an stdClass' => [
				'value' => (object) [1, 2, 3],
			],
			'With an ArrayObject' => [
				'value' => new ArrayObject([1, 2, 3]),
			],
		];
	}
}
