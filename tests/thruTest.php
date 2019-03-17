<?php

/**
 * @covers Dash\thru
 * @covers Dash\Curry\thru
 */
class thruTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($value)
	{
		$passed = null;

		$result = Dash\thru($value, function ($passed) use ($value) {
			$this->assertSame($value, $passed);
			$passed = 'changed';
			return $passed;
		});

		$this->assertSame('changed', $result);
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($value)
	{
		$passed = null;

		$thru = Dash\Curry\thru(function ($passed) use ($value) {
			$this->assertSame($value, $passed);
			$passed = 'changed';
			return $passed;
		});

		$this->assertSame('changed', $thru($value));
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

	public function testExamples()
	{
		$result = Dash\chain([1, 3, 4])
			->filter('Dash\isOdd')
			->thru(function ($value) {
				// $value === [1, 3]
				$value[] = $value[0];
				return $value;
			})
			->value();

		$this->assertSame([1, 3, 1], $result);
	}
}
