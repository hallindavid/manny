<?php
namespace Hallindavid\PhoneHelper\Tests;

use Orchestra\Testbench\TestCase;

class E164NoLeadingOneTest extends TestCase
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
        $this->assertEquals(PhoneHelper::format('', 'E.164'), "");
    }

    public function test_1_digits() {
    	$this->assertEquals(PhoneHelper::format('2', 'E.164'), "+12");
    }

    public function test_2_digits() {
        $this->assertEquals(PhoneHelper::format('23', 'E.164'), "+123");
    }
    
    public function test_3_digits() {
        $this->assertEquals(PhoneHelper::format('234', 'E.164'), "+1234");
    }
    
    public function test_4_digits() {
        $this->assertEquals(PhoneHelper::format('2345', 'E.164'), "+12345");
    }
    
    public function test_5_digits() {
        $this->assertEquals(PhoneHelper::format('23456', 'E.164'), "+123456");
    }
    
    public function test_6_digits() {
        $this->assertEquals(PhoneHelper::format('234567', 'E.164'), "+1234567");
    }

    public function test_7_digits() {
        $this->assertEquals(PhoneHelper::format('2345678', 'E.164'), "+12345678");
    }
    
    public function test_8_digits() {
        $this->assertEquals(PhoneHelper::format('23456789', 'E.164'), "+123456789");
    }

    public function test_9_digits() {
        $this->assertEquals(PhoneHelper::format('234567891', 'E.164'), "+1234567891");
    }

    public function test_10_digits() {
        $this->assertEquals(PhoneHelper::format('2345678912', 'E.164'), "+12345678912");
    }

    public function test_11_digits() {
        $this->assertEquals(PhoneHelper::format('23456789123', 'E.164'), "+12345678912");
    }

    public function test_12_digits() {
        $this->assertEquals(PhoneHelper::format('234567891234', 'E.164'), "+12345678912");
    }

    public function test_13_digits() {
        $this->assertEquals(PhoneHelper::format('2345678912345', 'E.164'), "+12345678912");
    }

    public function test_14_digits() {
        $this->assertEquals(PhoneHelper::format('23456789123456', 'E.164'), "+12345678912");
    }

}