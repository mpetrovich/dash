<?php

use Dash\_;

class _Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider getTestCases
	 */
	public function testConstructor($value)
	{
		$container = new _($value);

		if ($value instanceof Traversable || is_object($value)) {
			$this->assertEquals(Dash\toArray($value), $container->value());
		}
		else {
			$this->assertEquals($value, $container->value());
		}
	}

	public function testConstructorWithDefaultValue()
	{
		$container = new _();
		$this->assertEquals(array(), $container->value());
	}

	/**
	 * @dataProvider getTestCases
	 */
	public function testWith($value)
	{
		$container = new _();
		$return = $container->with($value);

		if ($value instanceof Traversable || is_object($value)) {
			$this->assertEquals(Dash\toArray($value), $container->value());
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
		$doubleOdds = new _();
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
		$container = new _(array(1, 2, 3));
		$container->foo();
	}
}
