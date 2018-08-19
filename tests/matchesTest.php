<?php

/**
 * @covers Dash\matches
 */
class matchesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($properties, $value, $expected)
	{
		$matches = Dash\matches($properties);
		$this->assertSame($expected, $matches($value));
	}

	public function cases()
	{
		return [
			'With matching arrays' => [
				'properties' => ['b' => 2, 'd' => 4],
				'value' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => true,
			],
			'With non-matching arrays where keys do not match' => [
				'properties' => ['b' => 2, 'x' => 4],
				'value' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
			'With non-matching arrays where values do not match' => [
				'properties' => ['b' => 2, 'd' => 9],
				'value' => ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
			'With matching objects' => [
				'properties' => (object) ['b' => 2, 'd' => 4],
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => true,
			],
			'With non-matching objects where keys do not match' => [
				'properties' => (object) ['b' => 2, 'x' => 4],
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
			'With non-matching objects where values do not match' => [
				'properties' => (object) ['b' => 2, 'd' => 9],
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4],
				'expected' => false,
			],
		];
	}
}
