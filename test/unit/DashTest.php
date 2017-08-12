<?php

use Dash\_;

class DashTest extends PHPUnit_Framework_TestCase
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
}
