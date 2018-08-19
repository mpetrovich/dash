<?php

class GeneratorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function testComposing($generator)
	{
		$result = Dash\join(
			Dash\map(
				Dash\take(
					Dash\filter(
						$generator(),
						'Dash\isEven'
					),
					3
				)
			),
			', '
		);
		$this->assertSame('2, 4, 6', $result);
	}

	/**
	 * @dataProvider cases
	 */
	public function testChaining($generator)
	{
		$result = Dash\chain($generator())
			->filter('Dash\isEven')
			->take(3)
			->join(', ')
			->value();

		$this->assertSame('2, 4, 6', $result);
	}

	public function cases()
	{
		return [
			'With a finite generator' => [
				function () {
					foreach (range(1, 10) as $key => $value) {
						yield $key => $value;
					}
				},
			],
			'With an infinite generator' => [
				function () {
					$current = 1;
					while (true) {
						yield $current;
						$current++;
					}
				},
			],
		];
	}
}
