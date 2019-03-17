<?php

/**
 * @covers Dash\Dash
 */
class DashTest extends PHPUnit_Framework_TestCase
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
			Data types
		 */

		$this->assertSame(
			[4, 8],
			Dash\chain([1, 2, 3, 4])
				->filter('Dash\isEven')
				->map(function ($value) {
					return $value * 2;
				})
				->value()
		);

		$this->assertSame(
			'a, c',
			Dash\chain((object) ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4])
				->filter('Dash\isOdd')
				->keys()
				->join(', ')
				->value()
		);

		$this->assertSame(
			5,
			Dash\chain(new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]))
				->pick(['b', 'c'])
				->values()
				->sum()
				->value()
		);

		$iterator = new \FilesystemIterator(__DIR__, \FilesystemIterator::SKIP_DOTS);
		$filenames = Dash\chain($iterator)
			->reject(function ($fileinfo) {
				return $fileinfo->isDir();
			})
			->map(function ($fileinfo) {
				return pathinfo($fileinfo)['filename'];
			})
			->value();

		$this->assertGreaterThan(10, count($filenames));

		/*
			Custom operation
		 */

		Dash\Dash::setCustom('keyCase', function ($input, $case = CASE_LOWER) {
			return array_change_key_case($input, $case);
		});

		$result = Dash\chain(['one' => 1, 'two' => 2, 'three' => 3])
			->filter('Dash\isOdd')
			->keyCase(CASE_UPPER)
			->keys()
			->value();

		Dash\Dash::unsetCustom('keyCase');
		$this->assertSame(['ONE', 'THREE'], $result);
	}

	public function testExamples()
	{
		$this->assertSame(
			[2, 4, 6],
			Dash\Dash::map([1, 2, 3], function ($n) { return $n * 2; })
		);

		$result = Dash\Dash::chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; })
			->value();
		$this->assertSame([2, 4], $result);
	}

	public function testCurryExamples()
	{
		// @codingStandardsIgnoreLine
		function DashTest_listThree($a, $b, $c)
		{
			return "$a, $b, and $c";
		}

		$listThree = Dash\curry('DashTest_listThree');
		$listTwo = $listThree('first');
		$this->assertSame('first, second, and third', $listTwo('second', 'third'));

		$filtered = Dash\Dash::chain(['a' => 3, 'b' => '3', 'c' => 3, 'd' => 3.0])
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
		Dash\Dash::addGlobalAlias();
		$chain = __([1, 2, 3]);

		$this->assertInstanceOf('Dash\Dash', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	public function testAddGlobalAliasWithCustom()
	{
		Dash\Dash::addGlobalAlias('DashTest_dash');
		$chain = DashTest_dash([1, 2, 3]);

		$this->assertInstanceOf('Dash\Dash', $chain);
		$this->assertSame([1, 2, 3], $chain->value());

		$chain->map(function ($n) { return $n * 2; });
		$this->assertSame([2, 4, 6], $chain->value());
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testAddGlobalAliasWithExisting()
	{
		$name = 'DashTest_dash' . intval(microtime(true));
		eval("function $name() {}");

		Dash\Dash::addGlobalAlias($name);
	}

	/*
		chain()
		------------------------------------------------------------
	 */

	public function testChain()
	{
		$chain = Dash\Dash::chain([1, 2, 3]);
		$this->assertSame([1, 2, 3], $chain->value());
	}

	public function testChainWithArray()
	{
		$chain = Dash\Dash::chain([1, 2, 3])
			->filter(function ($n) { return $n < 3; })
			->map(function ($n) { return $n * 2; });

		$this->assertSame([2, 4], $chain->value());
	}

	public function testChainWithObject()
	{
		$chain = Dash\Dash::chain((object) ['a' => 1, 'b' => 2, 'c' => 3])
			->pick(['b', 'c'])
			->toObject();

		$this->assertEquals((object) ['b' => 2, 'c' => 3], $chain->value());
	}

	public function testChainWithDefault()
	{
		$chain = Dash\Dash::chain()
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
		$chain = Dash\Dash::chain([1, 2, 3])->map(function ($n) { return $n * 2; });
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

		Dash\Dash::setCustom('triple', function ($value) {
			return $value * 3;
		});

		$this->assertSame(12, Dash\Dash::triple(4));

		/*
			unsetCustom()
		 */

		Dash\Dash::unsetCustom('triple');

		try {
			Dash\Dash::triple(2);
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
		Dash\Dash::setCustom('map', function ($n) {});
	}

	public function testCustomOperationForNumbersStandalone()
	{
		Dash\Dash::setCustom('triple', function ($value) {
			return $value * 3;
		});

		$this->assertSame(12, Dash\Dash::triple(4));

		Dash\Dash::unsetCustom('triple');
	}

	public function testCustomOperationForNumbersChained()
	{
		Dash\Dash::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertSame(8, Dash\Dash::chain(4)->double()->value());

		Dash\Dash::unsetCustom('double');
	}

	public function testCustomOperationForIterablesStandalone()
	{
		Dash\Dash::setCustom('addEach', function ($iterable, $add) {
			return Dash\Dash::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$this->assertSame(
			[4, 5, 6],
			Dash\Dash::addEach([1, 2, 3], 3)
		);

		Dash\Dash::unsetCustom('addEach');
	}

	public function testCustomOperationForIterablesChained()
	{
		Dash\Dash::setCustom('addEach', function ($iterable, $add) {
			return Dash\Dash::map($iterable, function ($n) use ($add) { return $n + $add; });
		});

		$this->assertSame(
			[4, 5, 6],
			Dash\Dash::chain([1, 2, 3])->addEach(3)->value()
		);

		Dash\Dash::unsetCustom('addEach');
	}

	public function testCustomOperationLookup()
	{
		Dash\Dash::setCustom('double', function ($value) {
			return $value * 2;
		});

		$this->assertSame(
			[2, 4, 6],
			Dash\Dash::chain([1, 2, 3])->map(Dash\Dash::getCustom('double'))->value()
		);

		$this->assertSame(
			[2, 4, 6],
			Dash\Dash::chain([1, 2, 3])->map('Dash\Dash::double')->value()
		);

		Dash\Dash::unsetCustom('double');
	}

	/*
		Standalone operations
		------------------------------------------------------------
	 */

	public function testStandalone()
	{
		$this->assertSame(
			[2, 4, 6],
			Dash\Dash::map([1, 2, 3], function ($n) { return $n * 2; })
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No operation named 'foobar' found
	 */
	public function testStandaloneInvalid()
	{
		Dash\Dash::foobar([1, 2, 3]);
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
		$chain = Dash\Dash::chain();
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
		$chain = Dash\Dash::chain((object) [1, 2, 3]);

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
		$value = Dash\Dash::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; })
			->arrayValue();

		$this->assertSame([2, 4, 6], $value);
		$this->assertInternalType('array', $value);
	}

	public function testObjectValue()
	{
		$value = Dash\Dash::chain([1, 2, 3])
			->map(function ($n) { return $n * 2; })
			->objectValue();

		$this->assertEquals((object) [2, 4, 6], $value);
		$this->assertInstanceOf('stdClass', $value);
	}

	public function testRun()
	{
		$obj = (object) ['a' => 1];

		$chain = Dash\Dash::chain($obj)->tap(function ($obj) { $obj->a = 2; });
		$this->assertEquals((object) ['a' => 1], $obj);

		$chain->run();
		$this->assertEquals((object) ['a' => 2], $obj);
	}

	public function testRunExamples()
	{
		ob_start();
		Dash\Dash::chain([1, 2, 3])
			->each(function ($n) { echo $n; })
			->run();
		$output = ob_get_clean();

		$this->assertSame('123', $output);
	}

	public function testCopy()
	{
		$original = Dash\Dash::chain()->map(function ($n) { return $n * 2; });

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
		$original = Dash\Dash::chain()->map(function ($n) { return $n * 2; });

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
		Dash\Dash::chain([1, 2, 3])
			->foo()
			->value();
	}
}
