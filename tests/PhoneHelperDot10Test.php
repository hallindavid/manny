<?php

require_once 'vendor/autoload.php';

use Manny\PhoneHelper\Dot10;
use PHPUnit\Framework\TestCase;

class PhoneHelperDot10Test extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals((new Dot10(''))->format(), '');
    }

    public function test_1_char()
    {
        $this->assertEquals((new Dot10('8'))->format(), '8');
    }

    public function test_4_char()
    {
        $this->assertEquals((new Dot10('8008'))->format(), '800.8');
    }

    public function test_full()
    {
        $this->assertEquals((new Dot10('8008008000'))->format(), '800.800.8000');
    }

    public function test_overflow()
    {
        $this->assertEquals((new Dot10('8008008000123456'))->format(), '800.800.8000');
    }

    public function test_invalid()
    {
        $this->assertEquals((new Dot10('Where in the World Is Carmen Sandiego?'))->format(), '');
    }
}
