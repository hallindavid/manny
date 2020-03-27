<?php
namespace Hallindavid\PhoneHelper\Tests;

use Orchestra\Testbench\TestCase;

class Format11LeadingOneTest extends TestCase
{
	protected function getPackageProviders($app)
	{
	    return [
	    	\Hallindavid\PhoneHelper\PhoneHelperServiceProvider::class
	    ];
	}
	protected function getPackageAliases($app)
	{
	    return [
	        PhoneHelper::class => \Hallindavid\PhoneHelper\PhoneHelperFacade::class
	    ];
	}
    
    public function test_0_digits() {
        $this->assertEquals("", PhoneHelper::format('', '11'));
    }

    public function test_1_digits() {
    	$this->assertEquals("1", PhoneHelper::format('1', '11'));
    }

    public function test_2_digits() {
        $this->assertEquals("12", PhoneHelper::format('12', '11'));
    }
    
    public function test_3_digits() {
        $this->assertEquals("123", PhoneHelper::format('123', '11'));
    }
    
    public function test_4_digits() {
        $this->assertEquals("1234", PhoneHelper::format('1234', '11'));
    }
    
    public function test_5_digits() {
        $this->assertEquals("12345", PhoneHelper::format('12345', '11'));
    }
    
    public function test_6_digits() {
        $this->assertEquals("123456", PhoneHelper::format('123456', '11'));
    }

    public function test_7_digits() {
        $this->assertEquals("1234567", PhoneHelper::format('1234567', '11'));
    }
    
    public function test_8_digits() {
        $this->assertEquals("12345678", PhoneHelper::format('12345678', '11'));
    }

    public function test_9_digits() {
        $this->assertEquals("123456789", PhoneHelper::format('123456789', '11'));
    }

    public function test_10_digits() {
        $this->assertEquals("1234567891", PhoneHelper::format('1234567891', '11'));
    }

    public function test_11_digits() {
        $this->assertEquals("12345678912", PhoneHelper::format('12345678912', '11'));
    }

    public function test_12_digits() {
        $this->assertEquals("12345678912", PhoneHelper::format('123456789123', '11'));
    }

    public function test_13_digits() {
        $this->assertEquals("12345678912", PhoneHelper::format('1234567891234', '11'));
    }

    public function test_14_digits() {
        $this->assertEquals("12345678912", PhoneHelper::format('12345678912345', '11'));
    }
}