<?php

use Dash\Container;

class ContainerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider getTestCases
	 */
	public function testConstructor($value)
	{
		$container = new Container($value);
		$this->assertEquals($value, $container->value());
	}

	public function testConstructorWithDefaultValue()
	{
		$container = new Container();
		$this->assertEquals(array(), $container->value());
	}

	/**
	 * @dataProvider getTestCases
	 */
	public function testWith($value)
	{
		$container = new Container();
		$return = $container->with($value);

		$this->assertEquals($value, $container->value());
		$this->assertSame($container, $return);
	}

	public function getTestCases()
	{
		return array(
			'With an empty array' => array(
				array()
			),
			'With an indexed array' => array(
				array(
					'first',
					'second',
					'third',
				)
			),
			'With an associative array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				)
			),
			'With an empty object' => array(
				(object) array()
			),
			'With a non-empty object' => array(
				(object) array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				)
			),
			'With an empty string' => array(
				''
			),
			'With a non-empty string' => array(
				'hello'
			),
			'With a number' => array(
				3.14
			),
			'With null' => array(
				null
			),
		);
	}
}
