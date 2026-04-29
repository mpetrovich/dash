<?php

/**
 * @covers Dash\zip
 * @covers Dash\Generator\zip
 */
class zipTest extends PHPUnit\Framework\TestCase
{
	public function testNoArguments()
	{
		$this->assertSame([], Dash\zip());
	}

	/**
	 * @dataProvider cases
	 */
	public function test($args, $expected)
	{
		$this->assertEquals($expected, call_user_func_array('Dash\zip', $args));
	}

	public function cases()
	{
		return [
			'two arrays' => [
				'args' => [[1, 2, 3], [10, 20, 30]],
				'expected' => [[1, 10], [2, 20], [3, 30]],
			],
			'shortest wins' => [
				'args' => [[1, 2], [10, 20, 99]],
				'expected' => [[1, 10], [2, 20]],
			],
			'single column' => [
				'args' => [[1, 2, 3]],
				'expected' => [[1], [2], [3]],
			],
			'null as empty' => [
				'args' => [[1, 2], null],
				'expected' => [],
			],
		];
	}

	public function testGenerator()
	{
		$a = (function () {
			yield 1;
			yield 2;
		})();
		$b = [10, 20, 30];

		$result = Dash\zip($a, $b);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame([[1, 10], [2, 20]], iterator_to_array($result, false));
	}
}
