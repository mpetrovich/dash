<?php

/**
 * @covers Dash\pipe
 */
class pipeTest extends PHPUnit_Framework_TestCase
{
    public function testCanPipeOneUnaryFunction()
    {
        $addOne = function ($v) {
            return $v + 1;
        };
        $piped = Dash\pipe($addOne);

        $this->assertSame(2, $piped(1));
    }

    public function testCanPipeOneNonUnaryFunction()
    {
        $pow = function ($base, $exp) {
            return pow($base, $exp);
        };
        $piped = Dash\pipe($pow);

        $this->assertSame(8, $piped(2, 3));
    }

    public function testCanPipeTwoFunctions()
    {
        $addOne = function ($v) {
            return $v + 1;
        };
        $triple = function ($v) {
            return $v * 3;
        };
        $piped = Dash\pipe($addOne, $triple);

        $this->assertSame(6, $piped(1));
    }

    public function testCanPipeMoreThanTwoFunctions()
    {
        $addOne = function ($v) {
            return $v + 1;
        };
        $triple = function ($v) {
            return $v * 3;
        };
        $square = function ($v) {
            return $v * $v;
        };
        $piped = Dash\pipe($addOne, $triple, $square);

        $this->assertSame(36, $piped(1));
    }

    public function testFirstFunctionCanBeNonUnary()
    {
        $pow = function ($base, $exp) {
            return pow($base, $exp);
        };
        $addOne = function ($v) {
            return $v + 1;
        };
        $triple = function ($v) {
            return $v * 3;
        };
        $piped = Dash\pipe($pow, $addOne, $triple);

        $this->assertSame(27, $piped(2, 3));
    }
}
