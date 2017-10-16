<?php

/**
 * @covers Dash\getDirect
 * @covers Dash\_getDirect
 */
class getDirectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $key, $default, $expected)
	{
		$this->assertSame($expected, Dash\getDirect($iterable, $key, $default));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $key, $default, $expected)
	{
		$getDirect = Dash\_getDirect($key, $default);
		$this->assertSame($expected, $getDirect($iterable));
	}

	public function cases()
	{
		$func = function () { return 'result'; };

		return [
			'With null' => [
				'iterable' => null,
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With matching null key' => [
				'iterable' => [null => 'value'],
				'key' => null,
				'default' => 'default',
				'expected' => 'value',
			],
			'With matching null value' => [
				'iterable' => ['a' => null],
				'key' => 'a',
				'default' => 'default',
				'expected' => null,
			],
			'With a callable value' => [
				'iterable' => ['a' => $func],
				'key' => 'a',
				'default' => 'default',
				'expected' => $func,
			],

			/*
				With array
			 */

			'With an empty array' => [
				'iterable' => [],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct array key' => [
				'iterable' => ['a' => 'value'],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct stdClass property' => [
				'iterable' => (object) ['a' => 'value'],
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'key' => 'a',
				'default' => 'default',
				'expected' => 'default',
			],
			'With a matching direct ArrayObject property' => [
				'iterable' => new ArrayObject(['a' => 'value']),
				'key' => 'a',
				'default' => 'default',
				'expected' => 'value',
			],
		];
	}

	public function testCallable()
	{
		$callable = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
		$this->assertInternalType('callable', $callable);
		$this->assertSame(3, call_user_func($callable));
	}

	/**
	 * @dataProvider casesDefault
	 */
	public function testDefault($iterable, $key, $expected)
	{
		$this->assertSame($expected, Dash\getDirect($iterable, $key));
	}

	public function casesDefault()
	{
		return [
			'With a matching key' => [
				'iterable' => ['a' => 'value'],
				'key' => 'a',
				'expected' => 'value',
			],
			'With a non-matching key' => [
				'iterable' => ['a' => 'value'],
				'key' => 'x',
				'expected' => null,
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\getDirect($iterable, 'foo');
		}
		catch (Exception $e) {
			$this->assertSame(
				"Dash\\getDirect expects iterable or stdClass or null but was given $type",
				$e->getMessage()
			);
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With an empty string' => [
				'iterable' => '',
				'type' => 'string',
			],
			'With a string' => [
				'iterable' => 'hello',
				'type' => 'string',
			],
			'With a zero number' => [
				'iterable' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'iterable' => 3.14,
				'type' => 'double',
			],
			'With a DateTime' => [
				'iterable' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}

	public function testExamples()
	{
		$this->assertSame(
			Dash\getDirect(['a' => 'one', 'b' => 'two'], 'b'),
			'two'
		);
		$this->assertSame(
			Dash\getDirect((object) ['a' => 'one', 'b' => 'two'], 'b'),
			'two'
		);

		$count = Dash\getDirect(new ArrayObject([1, 2, 3]), 'count');
		$this->assertSame($count(), 3);

		$iterable = new ArrayObject(['a' => 'array value']);
		$iterable->a = 'object value';
		$this->assertSame('array value', Dash\getDirect($iterable, 'a'));
	}
}
