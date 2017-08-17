<?php

/**
 * @covers Dash\thru
 */
class thruTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $interceptor, $expected)
	{
		$actual = Dash\thru($iterable, $interceptor);
		$this->assertSame($expected, $actual);
	}

	public function cases()
	{
		return [
			'should return the modified collection when the interceptor returns a modifed collection' => [
				['a' => 1, 'b' => 2],
				function ($iterable) {
					$iterable['c'] = 3;
					return $iterable;
				},
				['a' => 1, 'b' => 2, 'c' => 3]
			],
			'should return the new collection when the interceptor returns a new collection' => [
				['a' => 1, 'b' => 2],
				function () {
					return [2, 3, 5];
				},
				[2, 3, 5]
			],
		];
	}
}
