<?php

use Dash\_;

/**
 * @covers Dash\_
 */
class _Test extends PHPUnit_Framework_TestCase
{
	public function testGlobalAliasDefault()
	{
		_::addGlobalAlias();
		$chain = __([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertEquals([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertEquals([2, 4, 6], $chain->value());
	}

	public function testGlobalAliasCustom()
	{
		_::addGlobalAlias('dash');
		$chain = dash([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertEquals([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertEquals([2, 4, 6], $chain->value());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGlobalAliasExisting()
	{
		$name = 'dash' . intval(microtime(true));
		eval("function $name() {}");

		_::addGlobalAlias($name);
	}

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
		return [
			[
				'map',
				[[1, 2, 3], function ($n) { return $n * 2; }],
				[2, 4, 6],
			]
		];
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No callable method found for "foobar"
	 */
	public function testStandaloneInvalid()
	{
		_::foobar([1, 2, 3]);
	}

	public function testChain()
	{
		$chain = _::chain([1, 2, 3]);
		$this->assertEquals([1, 2, 3], $chain->value());
	}

	public function testChainingWithArray()
	{
		$chain = _::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; })
			->filter(function ($n) { return $n < 6; });

		$this->assertEquals([2, 4], $chain->value());
	}

	public function testChainingWithObject()
	{
		$chain = _::chain((object) ['a' => 1, 'b' => 2, 'c' => 3])
			->pick(['b', 'c']);

		$this->assertEquals((object) ['b' => 2, 'c' => 3], $chain->value());
	}

	public function testChainingWithoutInitialValue()
	{
		$chain = _::chain()
			->map(function ($n) { return $n * 2; })
			->filter(function ($n) { return $n < 6; });

		try {
			$chain->value();
			$this->assertFalse(true);
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}

		$actual = $chain->with([1, 2, 3])->value();
		$expected = [2, 4];
		$this->assertEquals($expected, $actual);
	}

	public function testChainingReuse()
	{
		$chain = _::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; });

		$this->assertEquals([2, 4, 6], $chain->value());

		$chain->with([4, 5, 6]);

		$this->assertEquals([8, 10, 12], $chain->value());
	}

	public function testValueCaching()
	{
		$mapCallCount = 0;

		$chain = _::chain((object) [1, 2, 3]);

		$this->assertEquals((object) [1, 2, 3], $chain->value());

		$chain->map(function ($n) use (&$mapCallCount) {
			$mapCallCount++;
			return $n * 2;
		});

		$this->assertEquals([2, 4, 6], $chain->value());
		$this->assertEquals(3, $mapCallCount);
		$this->assertEquals([2, 4, 6], $chain->value());
		$this->assertEquals(3, $mapCallCount);

		$chain->with((object) [4, 5, 6]);

		$this->assertEquals([8, 10, 12], $chain->value());
		$this->assertEquals(6, $mapCallCount);
		$this->assertEquals([8, 10, 12], $chain->value());
		$this->assertEquals(6, $mapCallCount);

		$chain->map(function ($n) { return $n + 1;});

		$this->assertEquals([9, 11, 13], $chain->value());
		$this->assertEquals(9, $mapCallCount);
		$this->assertEquals([9, 11, 13], $chain->value());
		$this->assertEquals(9, $mapCallCount);
	}

	public function testRun()
	{
		$obj = (object) ['a' => 1];

		$chain = _::chain($obj)->tap(function ($obj) { $obj->a = 2; });
		$this->assertEquals((object) ['a' => 1], $obj);

		$chain->run();
		$this->assertEquals((object) ['a' => 2], $obj);
	}

	public function testChainingCloning()
	{
		$chain = _::chain()->map(function ($n) { return $n * 2; });

		$chain->with([1, 2, 3]);
		$this->assertEquals([2, 4, 6], $chain->value());

		$clone = clone $chain;
		$clone->map(function ($n) { return $n + 1; });

		$clone->with([4, 5, 6]);
		$this->assertEquals([9, 11, 13], $clone->value());

		$chain->with([1, 2, 3]);
		$this->assertEquals([2, 4, 6], $chain->value());
	}

	public function testCopy()
	{
		$chain = _::chain()->map(function ($n) { return $n * 2; });

		$chain->with([1, 2, 3]);
		$this->assertEquals([2, 4, 6], $chain->value());

		$clone = $chain->copy();
		$clone->map(function ($n) { return $n + 1; });

		$clone->with([4, 5, 6]);
		$this->assertEquals([9, 11, 13], $clone->value());

		$chain->with([1, 2, 3]);
		$this->assertEquals([2, 4, 6], $chain->value());
	}

	/**
	 * @dataProvider getTestCases
	 */
	public function testWith($value)
	{
		$chain = _::chain();
		$return = $chain->with($value);

		$this->assertSame($value, $chain->value());
		$this->assertSame($chain, $return);
	}

	public function getTestCases()
	{
		return [
			'With an empty array' => [
				[]
			],
			'With an indexed array' => [
				[
					'first',
					'second',
					'third',
				]
			],
			'With an associative array' => [
				[
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				]
			],
			'With an empty object' => [
				(object) []
			],
			'With an object' => [
				(object) [
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				]
			],
			'With an empty string' => [
				''
			],
			'With a string' => [
				'hello'
			],
			'With a number' => [
				3.14
			],
			'With null' => [
				null
			],
		];
	}

	public function testDeferredEvaluation()
	{
		$doubleOdds = _::chain();
		$doubleOdds
			->filter('Dash\_::isOdd')
			->map(function ($n) { return $n * 2; });

		$this->assertEquals(
			[2, 6],
			$doubleOdds->with([1, 2, 3])->value()
		);
		$this->assertEquals(
			[14, 18, 22, 26],
			$doubleOdds->with([7, 9, 11, 13])->value()
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No callable method found for "foo"
	 */
	public function testInvalidChainMethod()
	{
		$chain = _::chain([1, 2, 3]);
		$chain->foo();
	}

	public function testCustomFunctionSetUnset()
	{
		/*
			Tests setCustom()
		 */

		_::setCustom('triple', function ($value) {
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
		catch (Exception $e) {
			// Swallowed
		}

		$this->assertFalse($isStillSet);
	}

	public function testCustomFunctionWithArray()
	{
		_::setCustom('addEach', function ($array, $add) {
			return _::map($array, function ($n) use ($add) { return $n + $add; });
		});

		$this->assertEquals(
			[4, 5, 6],
			_::chain([1, 2, 3])->addEach(3)->value()
		);

		_::unsetCustom('addEach');
	}

	public function testCustomFunctionWithScalarStandalone()
	{
		_::setCustom('triple', function ($value) {
			return $value * 3;
		});

		$this->assertEquals(12, _::triple(4));

		_::unsetCustom('triple');
	}

	public function testCustomFunctionWithScalarChained()
	{
		_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertEquals(8, _::chain(4)->double()->value());

		_::unsetCustom('double');
	}

	public function testCustomFunctionLookup()
	{
		_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertEquals(
			[2, 4, 6],
			_::chain([1, 2, 3])->map('Dash\_::double')->value()
		);

		_::unsetCustom('double');
	}

	/**
	 * @expectedException BadMethodCallException
	 * @expectedExceptionMessage Curried method _map() cannot be called in a chain. Use the non-curried map() instead.
	 */
	public function testChainingCurried()
	{
		_::chain([1, 2, 3])
			->_map('Dash\isOdd')
			->run();
	}
}
