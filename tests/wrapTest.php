<?php

/**
 * @covers Dash\wrap
 */
class wrapTest extends PHPUnit\Framework\TestCase
{
	public function testWrapsCallable()
	{
		$hello = function ($name) {
			return "hello $name";
		};

		$wrapped = Dash\wrap($hello, function ($fn, $name) {
			return strtoupper($fn($name)) . '!';
		});

		$this->assertSame('HELLO PETE!', $wrapped('pete'));
	}
}
