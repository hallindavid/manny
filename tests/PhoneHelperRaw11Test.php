<?php

require_once 'vendor/autoload.php';

use Manny\PhoneHelper\Raw11;
use PHPUnit\Framework\TestCase;

class PhoneHelperRaw11Test extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals((new Raw11(''))->format(), '');
    }

    public function test_1_char()
    {
        $this->assertEquals((new Raw11('8'))->format(), '18');
    }

    public function test_leading_1()
    {
        $this->assertEquals((new Raw11('1'))->format(), '1');
    }

    public function test_4_char()
    {
        $this->assertEquals((new Raw11('8008'))->format(), '18008');
    }

    public function test_full()
    {
        $this->assertEquals((new Raw11('8008008000'))->format(), '18008008000');
    }

    public function test_leading_one_full()
    {
        $this->assertEquals((new Raw11('18008008000'))->format(), '18008008000');
    }

    public function test_overflow()
    {
        $this->assertEquals((new Raw11('8008008000123456'))->format(), '18008008000');
    }

    public function test_leading_one_overflow()
    {
        $this->assertEquals((new Raw11('18008008000123456'))->format(), '18008008000');
    }

    public function test_invalid()
    {
        $this->assertEquals((new Raw11('Where in the World Is Carmen Sandiego?'))->format(), '');
    }
}
