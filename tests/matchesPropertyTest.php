<?php

/**
 * @covers Dash\matchesProperty
 * @covers Dash\Curry\matchesProperty
 */
class matchesPropertyTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($path, $value, $comparator, $input, $expected)
	{
		$matcher = Dash\matchesProperty($path, $value, $comparator);
		$this->assertSame($expected, $matcher($input));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($path, $value, $comparator, $input, $expected)
	{
		$matchesProperty = Dash\Curry\matchesProperty($value, $comparator);
		$matcher = $matchesProperty($path);
		$this->assertSame($expected, $matcher($input));
	}

	public function cases()
	{
		return [
			'With a null path' => [
				'path' => null,
				'value' => true,
				'comparator' => 'Dash\equal',
				'input' => ['foo' => 'bar'],
				'expected' => false,
			],
			'Matching a truthy field value' => [
				'path' => 'foo',
				'value' => true,
				'comparator' => 'Dash\equal',
				'input' => ['foo' => 'bar'],
				'expected' => true,
			],
			'Matching a strictly true field value' => [
				'path' => 'foo',
				'value' => true,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => true],
				'expected' => true,
			],
			'Not matching a strictly true field value' => [
				'path' => 'foo',
				'value' => true,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => 'bar'],
				'expected' => false,
			],
			'Matching a falsey field value' => [
				'path' => 'foo',
				'value' => false,
				'comparator' => 'Dash\equal',
				'input' => ['foo' => null],
				'expected' => true,
			],
			'Matching a strictly false field value' => [
				'path' => 'foo',
				'value' => false,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => false],
				'expected' => true,
			],
			'Not matching a strictly false field value' => [
				'path' => 'foo',
				'value' => false,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => null],
				'expected' => false,
			],
			'Matching a loosely equal field value' => [
				'path' => 'foo',
				'value' => 3,
				'comparator' => 'Dash\equal',
				'input' => ['foo' => 3.0],
				'expected' => true,
			],
			'Matching a strictly equal field value' => [
				'path' => 'foo',
				'value' => 3.0,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => 3.0],
				'expected' => true,
			],
			'Not matching a strictly equal field value' => [
				'path' => 'foo',
				'value' => 3,
				'comparator' => 'Dash\identical',
				'input' => ['foo' => 3.0],
				'expected' => false,
			],
			'With a matching array' => [
				'path' => 'a.b.c',
				'value' => 'value',
				'comparator' => 'Dash\equal',
				'input' => [
					'a' => [
						'b' => [
							'c' => 'value'
						]
					]
				],
				'expected' => true,
			],
			'With a non-matching array' => [
				'path' => 'a.X.c',
				'value' => 'value',
				'comparator' => 'Dash\equal',
				'input' => [
					'a' => [
						'b' => [
							'c' => 'value'
						]
					]
				],
				'expected' => false,
			],
			'With a matching object' => [
				'path' => 'a.b.c',
				'value' => 'value',
				'comparator' => 'Dash\equal',
				'input' => (object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'expected' => true,
			],
			'With a non-matching object' => [
				'path' => 'a.X.c',
				'value' => 'value',
				'comparator' => 'Dash\equal',
				'input' => (object) [
					'a' => (object) [
						'b' => (object) [
							'c' => 'value'
						]
					]
				],
				'expected' => false,
			],
		];
	}

	public function testExamples()
	{
		$matcher = Dash\matchesProperty('foo');
		$this->assertSame(true, $matcher(['foo' => 'bar']));
		$this->assertSame(false, $matcher(['foo' => null]));

		$matcher = Dash\matchesProperty('foo', false);
		$this->assertSame(true, $matcher(['foo' => false]));
		$this->assertSame(false, $matcher(['foo' => 'bar']));

		$matcher = Dash\matchesProperty('foo', 3);
		$this->assertSame(true, $matcher(['foo' => 3.0]));
		$this->assertSame(false, $matcher(['foo' => 4]));

		$matcher = Dash\matchesProperty('foo', 3, 'Dash\identical');
		$this->assertSame(true, $matcher(['foo' => 3]));
		$this->assertSame(false, $matcher(['foo' => 3.0]));
	}
}
