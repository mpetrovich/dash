<?php

/**
 * @covers Dash\lastly
 */
class lastlyTest extends PHPUnit\Framework\TestCase
{
	public function testReturnsMainFunctionResultAndRunsFinally()
	{
		$log = [];

		$wrapped = Dash\lastly(
			function ($value) use (&$log) {
				$log[] = "main:$value";
				return strtoupper($value);
			},
			function ($value) use (&$log) {
				$log[] = "finally:$value";
			}
		);

		$this->assertSame('ABC', $wrapped('abc'));
		$this->assertSame(['main:abc', 'finally:abc'], $log);
	}

	public function testRunsFinallyEvenWhenMainThrows()
	{
		$log = [];

		$wrapped = Dash\lastly(
			function () use (&$log) {
				$log[] = 'main';
				throw new RuntimeException('boom');
			},
			function () use (&$log) {
				$log[] = 'finally';
			}
		);

		$this->expectException(RuntimeException::class);
		$this->expectExceptionMessage('boom');

		try {
			$wrapped();
		} finally {
			$this->assertSame(['main', 'finally'], $log);
		}
	}
}
