<?php

/**
 * @covers Dash\mapKeys
 * @covers Dash\Curry\mapKeys
 * @covers Dash\Generator\mapKeys
 */
class mapKeysTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$iterable = ['a' => 1, 'b' => 2, 'c' => 3];
		$iteratee = function ($value, $key) {
			return $key . $value;
		};

		$this->assertSame(['a1' => 1, 'b2' => 2, 'c3' => 3], Dash\mapKeys($iterable, $iteratee));
	}

	public function testCurried()
	{
		$f = Dash\Curry\mapKeys(function ($value) {
			return 'k' . $value;
		});

		$this->assertSame(['k1' => 1, 'k2' => 2], $f(['a' => 1, 'b' => 2]));
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => 1;
			yield 'b' => 2;
		})();

		$result = Dash\mapKeys($iterable, function ($value, $key) {
			return $key . $value;
		});

		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame(['a1' => 1, 'b2' => 2], iterator_to_array($result));
	}

	public function testLaterCollisionsOverwriteEarlier()
	{
		$this->assertSame(['x' => 2], Dash\mapKeys(['a' => 1, 'b' => 2], function () {
			return 'x';
		}));
	}
}
