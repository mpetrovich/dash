<?php

/**
 * @covers Dash\currifyN
 */
class currifyNTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		// With single arguments
		$curried = Dash\currifyN($callable, 4);
		$curried = $curried();  // No-op
		$curried = $curried('two', 'three');
		$curried = $curried();  // No-op
		$curried = $curried('four');
		$curried = $curried();  // No-op
		$result = $curried('one');
		$this->assertSame('one, two, three, four', $result);

		// With multiple initial arguments
		$curried = Dash\currifyN($callable, 4);
		$result = $curried('two', 'three', 'four', 'one');
		$this->assertSame('one, two, three, four', $result);
	}

	public function testWithArgs()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		$curried = Dash\currifyN($callable, 4, ['two', 'three']);
		$result = $curried('four', 'one');
		$this->assertSame('one, two, three, four', $result);

		$curried = Dash\currifyN($callable, 4, ['two', 'three']);
		$curried = $curried('four');
		$curried = $curried();  // No-op
		$result = $curried('one');
		$this->assertSame('one, two, three, four', $result);
	}

	public function testWithRotate()
	{
		$callable = function (/* ...args */) {
			return implode(', ', func_get_args());
		};

		$curried = Dash\currifyN($callable, 4, ['three', 'four'], 2);
		$result = $curried('one', 'two');
		$this->assertSame('one, two, three, four', $result);

		$curried = Dash\currifyN($callable, 4, ['three', 'four'], 2);
		$curried = $curried('one');
		$curried = $curried();  // No-op
		$result = $curried('two');
		$this->assertSame('one, two, three, four', $result);
	}
}
