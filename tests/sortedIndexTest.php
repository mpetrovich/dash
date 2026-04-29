<?php

/**
 * @covers Dash\sortedIndex
 * @covers Dash\Curry\sortedIndex
 */
class sortedIndexTest extends PHPUnit\Framework\TestCase
{
	public function test()
	{
		$this->assertSame(0, Dash\sortedIndex([], 3));
		$this->assertSame(0, Dash\sortedIndex([10, 20, 30], 5));
		$this->assertSame(1, Dash\sortedIndex([10, 20, 30], 15));
		$this->assertSame(2, Dash\sortedIndex([10, 20, 30], 30));
		$this->assertSame(3, Dash\sortedIndex([10, 20, 30], 40));
	}

	public function testCurried()
	{
		$f = Dash\Curry\sortedIndex(15, 'Dash\compare');
		$this->assertSame(1, $f([10, 20, 30]));
	}

	public function testWithCustomComparator()
	{
		$cmp = function ($a, $b) {
			return strcmp(strtolower($a), strtolower($b));
		};

		$this->assertSame(1, Dash\sortedIndex(['alpha', 'charlie'], 'bravo', $cmp));
	}
}
