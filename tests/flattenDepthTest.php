<?php

/**
 * @covers Dash\flattenDepth
 * @covers Dash\Curry\flattenDepth
 * @covers Dash\Generator\flattenDepth
 */
class flattenDepthTest extends PHPUnit\Framework\TestCase
{
	public function testDepthMatchesFlattenChain()
	{
		$nested = [[1, [2, [3]]]];
		$this->assertEquals(Dash\flatten($nested), Dash\flattenDepth($nested, 1));
		$this->assertEquals(Dash\flatten(Dash\flatten($nested)), Dash\flattenDepth($nested, 2));
	}

	public function testDepthZero()
	{
		$a = ['a' => 1, 'b' => 2];
		$this->assertEquals($a, Dash\flattenDepth($a, 0));
		$this->assertEquals([1, [2]], Dash\flattenDepth([1, [2]], 0));
	}

	public function testNull()
	{
		$this->assertEquals([], Dash\flattenDepth(null, 5));
	}

	public function testCurried()
	{
		$f = Dash\Curry\flattenDepth(2);
		$this->assertEquals([1, 2, [3]], $f([[1, [2, [3]]]]));
	}

	public function testGenerator()
	{
		$gen = (function () {
			yield [1, [2]];
			yield [3];
		})();

		$r = Dash\flattenDepth($gen, 2);
		$this->assertInstanceOf(Generator::class, $r);
		$this->assertEquals([1, 2, 3], iterator_to_array($r, false));
	}
}
