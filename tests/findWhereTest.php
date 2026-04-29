<?php

/**
 * @covers Dash\findWhere
 * @covers Dash\Curry\findWhere
 * @covers Dash\Generator\findWhere
 */
class findWhereTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$input = [
			['name' => 'Jane', 'age' => 25, 'gender' => 'f'],
			['name' => 'Mike', 'age' => 30, 'gender' => 'm'],
			['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
			['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
		];

		$expected = [
			['name' => 'Abby', 'age' => 30, 'gender' => 'f'],
			['name' => 'Kate', 'age' => 30, 'gender' => 'f'],
		];

		$this->assertSame($expected, Dash\findWhere($input, ['gender' => 'f', 'age' => 30]));
	}

	public function testCurried()
	{
		$f = Dash\Curry\findWhere(['active' => true]);
		$this->assertSame([['active' => true]], $f([['active' => true], ['active' => false]]));
	}

	public function testGenerator()
	{
		$iterable = (function () {
			yield 'a' => ['active' => false];
			yield 'b' => ['active' => true];
			yield 'c' => ['active' => true];
		})();

		$result = Dash\findWhere($iterable, ['active' => true]);
		$this->assertInstanceOf(Generator::class, $result);
		$this->assertSame(['b' => ['active' => true], 'c' => ['active' => true]], iterator_to_array($result));
	}
}
