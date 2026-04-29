<?php

/**
 * @covers Dash\range
 * @covers Dash\Generator\range
 */
class rangeTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($start, $end, $step, $expected)
	{
		$this->assertSame($expected, Dash\range($start, $end, $step));
	}

	public function cases()
	{
		return [
			'One arg' => [5, null, 1, [0, 1, 2, 3, 4]],
			'Two args' => [2, 6, 1, [2, 3, 4, 5]],
			'Positive step' => [0, 7, 2, [0, 2, 4, 6]],
			'Negative step' => [5, 0, -2, [5, 3, 1]],
			'Wrong direction' => [0, 5, -1, []],
		];
	}

	public function testThrowsOnZeroStep()
	{
		$this->expectException(InvalidArgumentException::class);
		Dash\range(0, 5, 0);
	}

	public function testGenerator()
	{
		$this->assertSame([0, 1, 2], iterator_to_array(Dash\Generator\range(3), false));
	}
}
