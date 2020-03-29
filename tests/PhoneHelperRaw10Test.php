<?php

require_once 'vendor/autoload.php';

use Manny\PhoneHelper\Raw10;
use PHPUnit\Framework\TestCase;

class PhoneHelperRaw10Test extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals((new Raw10(''))->format(), '');
    }

    public function test_1_char()
    {
        $this->assertEquals((new Raw10('8'))->format(), '8');
    }

    public function test_4_char()
    {
        $this->assertEquals((new Raw10('8008'))->format(), '8008');
    }

    public function test_full()
    {
        $this->assertEquals((new Raw10('8008008000'))->format(), '8008008000');
    }

    public function test_overflow()
    {
        $this->assertEquals((new Raw10('8008008000123456'))->format(), '8008008000');
    }

    public function test_invalid()
    {
        $this->assertEquals((new Raw10('Where in the World Is Carmen Sandiego?'))->format(), '');
    }
}
