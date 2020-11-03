<?php

/**
 * @covers Dash\compose
 */
class composeTest extends PHPUnit_Framework_TestCase
{
    public function testCanComposeOneUnaryFunction()
    {
        $addOne = function ($v) {
            return $v + 1;
        };
        $composed = Dash\compose($addOne);

        $this->assertSame(2, $composed(1));
    }

    public function testCanComposeOneNonUnaryFunction()
    {
        $pow = function ($base, $exp) {
            return pow($base, $exp);
        };
        $composed = Dash\compose($pow);

        $this->assertSame(8, $composed(2, 3));
    }

    public function testCanComposeTwoFunctions()
    {
        $addOne = function ($v) {
            return $v + 1;
        };
        $triple = function ($v) {
            return $v * 3;
        };
        $composed = Dash\compose($triple, $addOne);

        $this->assertSame(6, $composed(1));
    }

    public function testCanComposeMoreThanTwoFunctions()
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
        $composed = Dash\compose($square, $triple, $addOne);

        $this->assertSame(36, $composed(1));
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
        $composed = Dash\compose($triple, $addOne, $pow);

        $this->assertSame(27, $composed(2, 3));
    }
}
