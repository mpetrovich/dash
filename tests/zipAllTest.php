<?php

/**
 * @covers Dash\zipAll
 * @covers Dash\Generator\zipAll
 */
class zipAllTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $expected)
	{
		$this->assertEquals($expected, call_user_func_array('Dash\zipAll', $args));
	}

	public function cases()
	{
		return [
			'no arguments' => [
				'args' => [],
				'expected' => [],
			],
			'pads with null' => [
				'args' => [[1, 2], [10]],
				'expected' => [[1, 10], [2, null]],
			],
			'aligned' => [
				'args' => [[1, 2], [10, 20]],
				'expected' => [[1, 10], [2, 20]],
			],
		];
	}

	public function testGenerator()
	{
		$a = (function () {
			yield 1;
		})();
		$b = (function () {
			yield 10;
			yield 20;
		})();

		$result = Dash\zipAll($a, $b);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame([[1, 10], [null, 20]], iterator_to_array($result, false));
	}
}
