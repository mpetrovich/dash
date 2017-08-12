<?php

use Dash\Container;
use Dash\Collections;

class ContainerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider getTestCases
	 */
	public function testConstructor($value)
	{
		$container = new Container($value);

		if ($value instanceof Traversable || is_object($value)) {
			$this->assertEquals(Collections\toArray($value), $container->value());
		}
		else {
			$this->assertEquals($value, $container->value());
		}
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

		if ($value instanceof Traversable || is_object($value)) {
			$this->assertEquals(Collections\toArray($value), $container->value());
		}
		else {
			$this->assertEquals($value, $container->value());
		}

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

	public function testDeferredEvaluation()
	{
		$doubleOdds = new Container();
		$doubleOdds
			->filter('Dash\_::isOdd')
			->map(function($n) { return $n * 2; });

		$this->assertEquals(
			array(2, 6),
			$doubleOdds->with(array(1, 2, 3))->value()
		);
		$this->assertEquals(
			array(14, 18, 22, 26),
			$doubleOdds->with(array(7, 9, 11, 13))->value()
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No callable method found for "foo"
	 */
	public function testInvalidChainMethod()
	{
		$container = new Container(array(1, 2, 3));
		$container->foo();
	}
}
