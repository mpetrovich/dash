<?php

use Dash\Container;

class compareTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForCompare
	 */
	public function testStandaloneCompare($a, $b, $expected)
	{
		$actual = Dash\compare($a, $b);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @dataProvider casesForCompare
	 */
	public function testChainedCompare($a, $b, $expected)
	{
		$container = new Container($a);
		$actual = $container->compare($b)->value();
		$this->assertSame($expected, $actual);
	}

	public function casesForCompare()
	{
		return array(
			'should return zero when the values are equal' => array(
				'3',
				3,
				0
			),
			'should return +1 when the first value is greater than the second' => array(
				'4',
				3,
				+1
			),
			'should return -1 when the first value is less than the second' => array(
				'2',
				3,
				-1
			),
		);
	}
}
