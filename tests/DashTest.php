<?php

use Dash\Dash;

class DashTest extends PHPUnit_Framework_TestCase
{
	public function testWith()
	{
		$container = Dash::with($value);
		$container->with($value);
		$this->assertEquals($value, $container->value());
	}

	public function testWithUsingDefaultValue()
	{
		$container = Dash::with();
		$this->assertNull($container->value());
	}
}
