<?php
namespace Hallindavid\PhoneHelper\Tests;

use Orchestra\Testbench\TestCase;

class Format11PlusBrackNoLeadingOneTest extends TestCase
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
        $this->assertEquals("", PhoneHelper::format('', '+11-brack'));
    }

    public function test_1_digits() {
    	$this->assertEquals("+1 (2", PhoneHelper::format('2', '+11-brack'));
    }

    public function test_2_digits() {
        $this->assertEquals("+1 (23", PhoneHelper::format('23', '+11-brack'));
    }
    
    public function test_3_digits() {
        $this->assertEquals("+1 (234", PhoneHelper::format('234', '+11-brack'));
    }
    
    public function test_4_digits() {
        $this->assertEquals("+1 (234) 5", PhoneHelper::format('2345', '+11-brack'));
    }
    
    public function test_5_digits() {
        $this->assertEquals("+1 (234) 56", PhoneHelper::format('23456', '+11-brack'));
    }
    
    public function test_6_digits() {
        $this->assertEquals("+1 (234) 567", PhoneHelper::format('234567', '+11-brack'));
    }

    public function test_7_digits() {
        $this->assertEquals("+1 (234) 567-8", PhoneHelper::format('2345678', '+11-brack'));
    }
    
    public function test_8_digits() {
        $this->assertEquals("+1 (234) 567-89", PhoneHelper::format('23456789', '+11-brack'));
    }

    public function test_9_digits() {
        $this->assertEquals("+1 (234) 567-891", PhoneHelper::format('234567891', '+11-brack'));
    }

    public function test_10_digits() {
        $this->assertEquals("+1 (234) 567-8912", PhoneHelper::format('2345678912', '+11-brack'));
    }

    public function test_11_digits() {
        $this->assertEquals("+1 (234) 567-8912", PhoneHelper::format('23456789123', '+11-brack'));
    }

    public function test_12_digits() {
        $this->assertEquals("+1 (234) 567-8912", PhoneHelper::format('234567891234', '+11-brack'));
    }

    public function test_13_digits() {
        $this->assertEquals("+1 (234) 567-8912", PhoneHelper::format('2345678912345', '+11-brack'));
    }

    public function test_14_digits() {
        $this->assertEquals("+1 (234) 567-8912", PhoneHelper::format('23456789123456', '+11-brack'));
    }

}