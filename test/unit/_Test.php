<?php

use Dash\_;

class _Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForStandalone
	 */
	public function testStandalone($method, $args, $expected)
	{
		$actual = call_user_func_array('Dash\_::' . $method, $args);
		$this->assertEquals($expected, $actual);
	}

	public function casesForStandalone()
	{
		return array(
			array(
				'map',
				array(array(1, 2, 3), function ($n) { return $n * 2; }),
				array(2, 4, 6),
			)
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No callable method found for "foobar"
	 */
	public function testStandaloneInvalid()
	{
		_::foobar(array(1, 2, 3));
	}

	public function testChain()
	{
		$chain = _::chain(array(1, 2, 3));
		$this->assertEquals(array(1, 2, 3), $chain->value());
	}

	public function testChainingWithInitialValue()
	{
		$chain = _::chain(array(1, 2, 3))
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n < 6; });

		$this->assertEquals(array(2, 4), $chain->value());
	}

	public function testChainingWithoutInitialValue()
	{
		$chain = _::chain()
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n < 6; });

		try {
			$chain->value();
			$this->assertFalse(true);
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}

		$actual = $chain->with(array(1, 2, 3))->value();
		$expected = array(2, 4);
		$this->assertEquals($expected, $actual);
	}

	public function testChainingReuse()
	{
		$chain = _::chain(array(1, 2, 3))
			->map(function($n) { return $n * 2; });

		$this->assertEquals(array(2, 4, 6), $chain->value());

		$chain->with(array(4, 5, 6));

		$this->assertEquals(array(8, 10, 12), $chain->value());
	}

	public function testChainingCloning()
	{
		$chain = _::chain()
			->map(function($n) { return $n * 2; });

		$chain->with(array(1, 2, 3));
		$this->assertEquals(array(2, 4, 6), $chain->value());

		$clone = clone $chain;
		$clone->map(function($n) { return $n + 1; });

		$clone->with(array(4, 5, 6));
		$this->assertEquals(array(9, 11, 13), $clone->value());
	}

	/**
	 * @dataProvider getTestCases
	 */
	public function testWith($value)
	{
		$chain = _::chain();
		$return = $chain->with($value);

		if ($value instanceof Traversable || is_object($value)) {
			$this->assertEquals(Dash\toArray($value), $chain->value());
		}
		else {
			$this->assertEquals($value, $chain->value());
		}

		$this->assertSame($chain, $return);
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
		$doubleOdds = _::chain();
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
		$chain = _::chain(array(1, 2, 3));
		$chain->foo();
	}

	public function testCustomFunctionStandalone() {

		/*
			Tests setCustom()
		 */

		_::setCustom('triple', function($value) {
			return $value * 3;
		});

		$this->assertEquals(12, _::triple(4));

		/*
			Tests unsetCustom()
		 */

		_::unsetCustom('triple');

		try {
			$isStillSet = false;
			_::triple(2);
			$isStillSet = true;
		}
		catch (Exception $e) {}

		$this->assertFalse($isStillSet);
	}

	public function testCustomFunctionChained() {
		_::setCustom('double', function($value) {
			return $value * 2;
		});

		$this->assertEquals(8, _::chain(4)->double()->value());

		_::unsetCustom('double');
	}
}