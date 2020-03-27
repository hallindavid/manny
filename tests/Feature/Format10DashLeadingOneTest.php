<?php
namespace Hallindavid\PhoneHelper\Tests;

use Orchestra\Testbench\TestCase;

class Format10DashLeadingOneTest extends TestCase
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
        $this->assertEquals("", PhoneHelper::format('', '10-dash'));
    }

    public function test_1_digits() {
    	$this->assertEquals("", PhoneHelper::format('1', '10-dash'));
    }

    public function test_2_digits() {
        $this->assertEquals("2", PhoneHelper::format('12', '10-dash'));
    }
    
    public function test_3_digits() {
        $this->assertEquals("23", PhoneHelper::format('123', '10-dash'));
    }
    
    public function test_4_digits() {
        $this->assertEquals("234", PhoneHelper::format('1234', '10-dash'));
    }
    
    public function test_5_digits() {
        $this->assertEquals("234-5", PhoneHelper::format('12345', '10-dash'));
    }
    
    public function test_6_digits() {
        $this->assertEquals("234-56", PhoneHelper::format('123456', '10-dash'));
    }

    public function test_7_digits() {
        $this->assertEquals("234-567", PhoneHelper::format('1234567', '10-dash'));
    }
    
    public function test_8_digits() {
        $this->assertEquals("234-567-8", PhoneHelper::format('12345678', '10-dash'));
    }

    public function test_9_digits() {
        $this->assertEquals("234-567-89", PhoneHelper::format('123456789', '10-dash'));
    }

    public function test_10_digits() {
        $this->assertEquals("234-567-891", PhoneHelper::format('1234567891', '10-dash'));
    }

    public function test_11_digits() {
        $this->assertEquals("234-567-8912", PhoneHelper::format('12345678912', '10-dash'));
    }

    public function test_12_digits() {
        $this->assertEquals("234-567-8912", PhoneHelper::format('123456789123', '10-dash'));
    }

    public function test_13_digits() {
        $this->assertEquals("234-567-8912", PhoneHelper::format('1234567891234', '10-dash'));
    }

    public function test_14_digits() {
        $this->assertEquals("234-567-8912", PhoneHelper::format('12345678912345', '10-dash'));
    }
}