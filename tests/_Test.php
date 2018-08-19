<?php

use Dash\_;

/**
 * @covers Dash\_
 */
class _Test extends PHPUnit_Framework_TestCase
{
	public function testReadmeExamples()
	{
		/*
			Dash vs. array_*()
		 */

		$people = [
			['name' => 'John', 'gender' => 'male',   'age' => 12],
			['name' => 'Jane', 'gender' => 'female', 'age' => 34],
			['name' => 'Pete', 'gender' => 'male',   'age' => 23],
			['name' => 'Mary', 'gender' => 'female', 'age' => 42],
			['name' => 'Mark', 'gender' => 'male',   'age' => 19],
		];

		$avgMaleAge = Dash\chain($people)
			->filter(['gender', 'male'])
			->map('age')
			->average()
			->value();
		$this->assertSame(18, $avgMaleAge);

		if (function_exists('array_column')) {  // array_column() requires PHP 5.5+
			$males = array_filter($people, function ($person) {
				return $person['gender'] === 'male';
			});
			$avgMaleAge = array_sum(array_column($males, 'age')) / count($males);
			$this->assertSame(18, $avgMaleAge);
		}

		/*
			Ad-hoc operation
		 */

		$result = Dash\chain(['one' => 1, 'two' => 2, 'three' => 3])
			->filter('Dash\isOdd')
			->thru(function($input) {
				return array_change_key_case($input, CASE_UPPER);
			})
			->keys()
			->value();
		$this->assertSame(['ONE', 'THREE'], $result);

		/*
			Custom operation
		 */

		_::setCustom('keyCase', function ($input, $case = CASE_LOWER) {
			return array_change_key_case($input, $case);
		});

		$result = Dash\chain(['one' => 1, 'two' => 2, 'three' => 3])
			->filter('Dash\isOdd')
			->keyCase(CASE_UPPER)
			->keys()
			->value();

		_::unsetCustom('keyCase');
		$this->assertSame(['ONE', 'THREE'], $result);
	}

	public function testExamples()
	{
		$this->assertSame(
			[2, 4, 6],
			_::map([1, 2, 3], function ($n) { return $n * 2; })
		);

		$result = _::chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; })
			->value();
		$this->assertSame([2, 4], $result);
	}

	public function testCurryExamples()
	{
		// @codingStandardsIgnoreLine
		function listThree($a, $b, $c)
		{
			return "$a, $b, and $c";
		}

		$listThree = Dash\curry('listThree');
		$listTwo = $listThree('first');
		$this->assertSame('first, second, and third', $listTwo('second', 'third'));

		$filtered = _::chain(['a' => 3, 'b' => '3', 'c' => 3, 'd' => 3.0])
			->filter(Dash\Curry\identical(3))
			->value();

		$this->assertSame(['a' => 3, 'c' => 3], $filtered);

		$containsTruthy = Dash\Curry\contains(true, 'Dash\equal');
		$this->assertTrue($containsTruthy([0, 1, 0]));

		$containsTrue = Dash\Curry\contains(true, 'Dash\identical');
		$this->assertFalse($containsTrue([0, 1, 0]));
	}

	/*
		addGlobalAlias()
		------------------------------------------------------------
	 */

	public function testAddGlobalAliasWithDefault()
	{
		_::addGlobalAlias();
		$chain = __([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	public function testAddGlobalAliasWithCustom()
	{
		_::addGlobalAlias('dash');
		$chain = dash([1, 2, 3]);

		$this->assertInstanceOf('Dash\_', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testAddGlobalAliasWithExisting()
	{
		$name = 'dash' . intval(microtime(true));
		eval("function $name() {}");

		_::addGlobalAlias($name);
	}

	/*
		chain()
		------------------------------------------------------------
	 */

	public function testChain()
	{
		$chain = _::chain([1, 2, 3]);
		$this->assertSame([1, 2, 3], $chain->value());
	}

	public function testChainWithArray()
	{
		$chain = _::chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; });

		$this->assertSame([2, 4], $chain->value());
	}

	public function testChainWithObject()
	{
		$chain = _::chain((object) ['a' => 1, 'b' => 2, 'c' => 3])
			->pick(['b', 'c'])
			->toObject();

		$this->assertEquals((object) ['b' => 2, 'c' => 3], $chain->value());
	}

	public function testChainWithDefault()
	{
		$chain = _::chain()
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; });

		try {
			$chain->value();
			$this->assertTrue(false, 'This should never be called');
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}

		$chain->with([1, 2, 3]);
		$this->assertSame([2, 4], $chain->value());
	}

	public function testChainReuse()
	{
		$chain = _::chain([1, 2, 3])->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());

		$chain->with([4, 5, 6]);
		$this->assertSame([8, 10, 12], $chain->value());
	}

	/*
		setCustom(), unsetCustom()
		------------------------------------------------------------
	 */

	public function testCustomOperation()
	{
		/*
			setCustom()
		 */

		_::setCustom('triple', function ($value) {
			return $value * 3;
		});

		$this->assertSame(12, _::triple(4));

		/*
			unsetCustom()
		 */

		_::unsetCustom('triple');

		try {
			_::triple(2);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}
	}

	/**
	 * @expectedException Exception
	 * @codingStandardsIgnoreLine
	 * @expectedExceptionMessage Cannot create a custom method named 'map'; Dash\map() already exists and cannot be overridden
	 */
	public function testCustomOperationWithExisting()
	{
		_::setCustom('map', function ($n) {});
	}

	public function testCustomOperationForNumbersStandalone()
	{
		_::setCustom('triple', function ($value) {
			return $value * 3;
		});

		$this->assertSame(12, _::triple(4));

		_::unsetCustom('triple');
	}

	public function testCustomOperationForNumbersChained()
	{
		_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertSame(8, _::chain(4)->double()->value());

		_::unsetCustom('double');
	}

	public function testCustomOperationForIterablesStandalone()
	{
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$this->assertSame(
			[4, 5, 6],
			_::addEach([1, 2, 3], 3)
		);

		_::unsetCustom('addEach');
	}

	public function testCustomOperationForIterablesChained()
	{
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$this->assertSame(
			[4, 5, 6],
			_::chain([1, 2, 3])->addEach(3)->value()
		);

		_::unsetCustom('addEach');
	}

	public function testCustomOperationLookup()
	{
		_::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertSame(
			[2, 4, 6],
			_::chain([1, 2, 3])->map('Dash\_::double')->value()
		);

		_::unsetCustom('double');
	}

	public function testCustomOperationWithAutoCurrying()
	{
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$add3 = _::_addEach(3);
		$this->assertSame([4, 5, 6], $add3([1, 2, 3]));

		_::unsetCustom('addEach');

		try {
			_::addEach([1, 2, 3], 3);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}

		try {
			_::_addEach([1, 2, 3], 3);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}
	}

	public function testCustomOperationWithoutAutoCurrying()
	{
		_::setCustom('addEach', function ($iterable, $add) {
			return _::map($iterable, function ($n) use ($add) { return $n + $add; });
		}, false);

		try {
			$add3 = _::_addEach(3);
			$this->assertTrue(false, 'This should never be called');
		}
		catch (BadMethodCallException $e) {
			$this->assertTrue(true);
		}

		_::unsetCustom('addEach');
	}

	/*
		Standalone operations
		------------------------------------------------------------
	 */

	public function testStandalone()
	{
		$this->assertSame(
			[2, 4, 6],
			Dash\_::map([1, 2, 3], function ($n) { return $n * 2; })
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No operation named 'foobar' found
	 */
	public function testStandaloneInvalid()
	{
		_::foobar([1, 2, 3]);
	}

	/*
		with()
		------------------------------------------------------------
	 */

	/**
	 * @dataProvider casesWith
	 */
	public function testWith($value)
	{
		$chain = _::chain();
		$return = $chain->with($value);

		$this->assertSame($value, $chain->value());
		$this->assertSame($chain, $return);
	}

	public function casesWith()
	{
		return [
			'With null' => [
				'value' => null,
			],
			'With a number' => [
				'value' => 3.14,
			],
			'With an empty string' => [
				'value' => '',
			],
			'With a string' => [
				'value' => 'hello',
			],
			'With an empty array' => [
				'value' => [],
			],
			'With an indexed array' => [
				'value' => [1, 2, 3],
			],
			'With an associative array' => [
				'value' => ['a' => 1, 'b' => 2, 'c' => 3],
			],
			'With an empty stdClass' => [
				'value' => (object) [],
			],
			'With an stdClass' => [
				'value' => (object) ['a' => 1, 'b' => 2, 'c' => 3],
			],
			'With an empty ArrayObject' => [
				'value' => new ArrayObject(),
			],
			'With an ArrayObject' => [
				'value' => new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3]),
			],
		];
	}

	/*
		value(), arrayValue(), objectValue(), run(), copy()
		------------------------------------------------------------
	 */

	public function testValue()
	{
		$chain = _::chain((object) [1, 2, 3]);

		$mapCallCount = 0;
		$chain->map(function ($n) use (&$mapCallCount) {
			$mapCallCount++;
			return $n * 2;
		});
		$this->assertSame(0, $mapCallCount);

		$this->assertSame([2, 4, 6], $chain->value());
		$this->assertSame(3, $mapCallCount);
		$this->assertSame([2, 4, 6], $chain->value());
		$this->assertSame(3, $mapCallCount);

		$chain->with((object) [4, 5, 6]);
		$this->assertSame([8, 10, 12], $chain->value());
		$this->assertSame(6, $mapCallCount);
		$this->assertSame([8, 10, 12], $chain->value());
		$this->assertSame(6, $mapCallCount);

		$chain->map(function ($n) { return $n + 1;});
		$this->assertSame([9, 11, 13], $chain->value());
		$this->assertSame(9, $mapCallCount);
		$this->assertSame([9, 11, 13], $chain->value());
		$this->assertSame(9, $mapCallCount);
	}

	public function testArrayValue()
	{
		$value = _::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; })
			->arrayValue();

		$this->assertSame([2, 4, 6], $value);
		$this->assertInternalType('array', $value);
	}

	public function testObjectValue()
	{
		$value = _::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; })
			->objectValue();

		$this->assertEquals((object) [2, 4, 6], $value);
		$this->assertInstanceOf('stdClass', $value);
	}

	public function testRun()
	{
		$obj = (object) ['a' => 1];

		$chain = _::chain($obj)->tap(function ($obj) { $obj->a = 2; });
		$this->assertEquals((object) ['a' => 1], $obj);

		$chain->run();
		$this->assertEquals((object) ['a' => 2], $obj);
	}

	public function testRunExamples()
	{
		ob_start();
		Dash\_::chain([1, 2, 3])
			->each(function ($n) { echo $n; })
			->run();
		$output = ob_get_clean();

		$this->assertSame('123', $output);
	}

	public function testCopy()
	{
		$original = _::chain()->map(function ($n) { return $n * 2; });

		$original->with([1, 2, 3]);
		$this->assertSame([2, 4, 6], $original->value());

		$copy = $original->copy();
		$copy->map(function ($n) { return $n + 1; });

		$copy->with([4, 5, 6]);
		$this->assertSame([9, 11, 13], $copy->value());

		$original->with([1, 2, 3]);
		$this->assertSame([2, 4, 6], $original->value());
	}

	public function testClone()
	{
		$original = _::chain()->map(function ($n) { return $n * 2; });

		$original->with([1, 2, 3]);
		$this->assertSame([2, 4, 6], $original->value());

		$copy = clone $original;
		$copy->map(function ($n) { return $n + 1; });

		$copy->with([4, 5, 6]);
		$this->assertSame([9, 11, 13], $copy->value());

		$original->with([1, 2, 3]);
		$this->assertSame([2, 4, 6], $original->value());
	}

	/*
		Invalid chaining
		------------------------------------------------------------
	 */

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No operation named 'foo' found
	 */
	public function testChainInvalidMethod()
	{
		_::chain([1, 2, 3])
			->foo()
			->value();
	}

	/**
	 * @expectedException BadMethodCallException
	 * @codingStandardsIgnoreLine
	 * @expectedExceptionMessage Curried method _map() cannot be called in a chain; use the uncurried map() method instead
	 */
	public function testChainCurriedMethod()
	{
		_::chain([1, 2, 3])
			->_map('Dash\isOdd')
			->value();
	}
}
