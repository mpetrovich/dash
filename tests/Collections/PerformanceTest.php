<?php

use Dash\Collections;

class PerformanceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForTestMapPerformance
	 */
	public function testMapPerformance($count)
	{
		$memoryLimit = ini_get('memory_limit');
		ini_set('memory_limit', '-1');

		for ($i = 0; $i < $count; $i++) {
			$collection[] = mt_rand(1, $count);
		}

		// Dash
		$start = microtime(true);
		$mappedDash = Collections\map($collection, function($value, $key) {
			return $value * $value;
		});
		$end = microtime(true);
		$elapsedDash = ($end - $start) * 1000;

		// Native
		$start = microtime(true);
		$mappedNative = array_map(function($value) {
			return $value * $value;
		}, $collection);
		$end = microtime(true);
		$elapsedNative = ($end - $start) * 1000;

		// Loop
		$start = microtime(true);
		$mappedLoop = array();
		$iteratee = function($value, $key) { return $value * $value; };
		foreach($collection as $key => $value) {
			$mappedLoop[] = call_user_func($iteratee, $value, $key);
		}
		$end = microtime(true);
		$elapsedLoop = ($end - $start) * 1000;

		print_r(array($count => array(
			'native' => sprintf('%0.3f ms', $elapsedNative),
			'for   ' => sprintf('%0.3f (%0.2fx)', $elapsedLoop, $elapsedLoop / $elapsedNative),
			'dash  ' => sprintf('%0.3f (%0.2fx)', $elapsedDash, $elapsedDash / $elapsedNative),
		)));

		ini_set('memory_limit', $memoryLimit);
		$this->assertSame($mappedNative, $mappedDash, 'Native and Dash results should be identical');
		$this->assertSame($mappedLoop, $mappedNative, 'Loop and native results should be identical');
		$this->assertLessThanOrEqual(10, $elapsedDash / $elapsedNative, 'Dash should be within an order of magnitude as fast as native');
		$this->assertLessThanOrEqual(10, $elapsedDash / $elapsedLoop, 'Dash should be within an order of magnitude as fast as loop');
		$this->assertLessThanOrEqual($elapsedLoop, $elapsedNative, 'Native should be the same or faster than loop');
	}

	public function casesForTestMapPerformance()
	{
		return array(
			array(1e1),
			array(1e2),
			array(1e3),
			array(1e4),
			array(1e5),
			// array(1e6),
		);
	}
}
