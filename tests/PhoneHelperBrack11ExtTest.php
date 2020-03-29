<?php

require_once 'vendor/autoload.php';

use Manny\PhoneHelper\Brack11Ext;
use PHPUnit\Framework\TestCase;

class PhoneHelperBrack11ExtTest extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals((new Brack11Ext(''))->format(), '');
    }

    public function test_1_char()
    {
        $this->assertEquals((new Brack11Ext('8'))->format(), '1 (8');
    }

    public function test_leading_1()
    {
        $this->assertEquals((new Brack11Ext('1'))->format(), '1');
    }

    public function test_4_char()
    {
        $this->assertEquals((new Brack11Ext('8008'))->format(), '1 (800) 8');
    }

    public function test_full()
    {
        $this->assertEquals((new Brack11Ext('8008008000'))->format(), '1 (800) 800-8000');
    }

    public function test_leading_one_full()
    {
        $this->assertEquals((new Brack11Ext('18008008000'))->format(), '1 (800) 800-8000');
    }

    public function test_overflow()
    {
        $this->assertEquals((new Brack11Ext('8008008000123456'))->format(), '1 (800) 800-8000 ext. 123456');
    }

    public function test_leading_one_overflow()
    {
        $this->assertEquals((new Brack11Ext('18008008000123456'))->format(), '1 (800) 800-8000 ext. 123456');
    }

    public function test_invalid()
    {
        $this->assertEquals((new Brack11Ext('Where in the World Is Carmen Sandiego?'))->format(), '');
    }
}
