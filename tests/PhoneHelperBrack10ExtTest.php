<?php

require_once 'vendor/autoload.php';

use Manny\PhoneHelper\Brack10Ext;
use PHPUnit\Framework\TestCase;

class PhoneHelperBrack10ExtTest extends TestCase
{
    public function test_blank_string()
    {
        $this->assertEquals((new Brack10Ext(''))->format(), '');
    }

    public function test_1_char()
    {
        $this->assertEquals((new Brack10Ext('8'))->format(), '(8');
    }

    public function test_3_char()
    {
        $this->assertEquals((new Brack10Ext('800'))->format(), '(800');
    }

    public function test_4_char()
    {
        $this->assertEquals((new Brack10Ext('8008'))->format(), '(800) 8');
    }

    public function test_full()
    {
        $this->assertEquals((new Brack10Ext('8008008000'))->format(), '(800) 800-8000');
    }

    public function test_overflow()
    {
        $this->assertEquals((new Brack10Ext('8008008000123456'))->format(), '(800) 800-8000 ext. 123456');
    }

    public function test_invalid()
    {
        $this->assertEquals((new Brack10Ext('Where in the World Is Carmen Sandiego?'))->format(), '');
    }
}
