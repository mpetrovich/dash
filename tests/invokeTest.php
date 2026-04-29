<?php

/**
 * @covers Dash\invoke
 */
class invokeTest extends PHPUnit\Framework\TestCase
{
	public function testInvokesPathCallableForEachElement()
	{
		$data = [
			['name' => 'john', 'toUpper' => function () { return 'JOHN'; }],
			['name' => 'jane', 'toUpper' => function () { return 'JANE'; }],
		];

		$this->assertSame(['JOHN', 'JANE'], array_values(Dash\invoke($data, 'toUpper')));
	}

	public function testInvokesMethodsWithArgs()
	{
		$data = [
			new ArrayObject([1, 2, 3]),
			new ArrayObject([4, 5]),
		];

		$this->assertSame([true, false], array_values(Dash\invoke($data, 'offsetExists', 2)));
	}

	public function testReturnsNullWhenNotCallable()
	{
		$data = [['name' => 'john']];
		$this->assertSame([null], array_values(Dash\invoke($data, 'name')));
	}
}
