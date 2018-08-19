<?php

/**
 * @covers Dash\ary
 * @covers Dash\Curry\ary
 */
class aryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($args, $arity, $expected)
	{
		$func = function () {
			return func_get_args();
		};

		$ary = Dash\ary($func, $arity);
		$this->assertSame($expected, call_user_func_array($ary, $args));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($args, $arity, $expected)
	{
		$func = function () {
			return func_get_args();
		};

		$ary = Dash\Curry\ary($arity);
		$this->assertSame($expected, call_user_func_array($ary($func), $args));
	}

	public function cases()
	{
		return [
			'With no args' => [
				'args' => [],
				'arity' => 3,
				'expected' => [],
			],
			'With negative arity' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => -1,
				'expected' => [],
			],
			'With zero arity' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => 0,
				'expected' => [],
			],
			'With arity of one' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => 1,
				'expected' => ['a'],
			],
			'With arity less than the number of args' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => 3,
				'expected' => ['a', 'b', 'c'],
			],
			'With arity equal to the number of args' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => 4,
				'expected' => ['a', 'b', 'c', 'd'],
			],
			'With arity greater than the number of args' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => 5,
				'expected' => ['a', 'b', 'c', 'd'],
			],
			'With a numeric string arity' => [
				'args' => ['a', 'b', 'c', 'd'],
				'arity' => '2',
				'expected' => ['a', 'b'],
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($arity, $type)
	{
		try {
			Dash\ary(function () {}, $arity);
		}
		catch (Exception $e) {
			$this->assertSame("Dash\\ary expects numeric but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With null' => [
				'arity' => null,
				'type' => 'NULL',
			],
			'With a non-numeric string' => [
				'arity' => 'hello',
				'type' => 'string',
			],
			'With a DateTime' => [
				'arity' => new DateTime(),
				'type' => 'DateTime',
			],
			'With an array' => [
				'arity' => [1, 2, 3],
				'type' => 'array',
			],
			'With an stdClass' => [
				'arity' => (object) [1, 2, 3],
				'type' => 'stdClass',
			],
			'With an ArrayObject' => [
				'arity' => new ArrayObject([1, 2, 3]),
				'type' => 'ArrayObject',
			],
		];
	}

	public function testExamples()
	{
		$isNumeric = Dash\ary('is_numeric', 1);
		$this->assertSame([1, 2.0, '3'], Dash\filter([1, 2.0, '3', 'a'], $isNumeric));
	}
}
