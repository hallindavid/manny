<?php
namespace Hallindavid\Manny\Tests;

use Orchestra\Testbench\TestCase;

class ShortcutsTest extends TestCase
{
	protected function getPackageProviders($app)
	{
	    return [
	    	\Hallindavid\Manny\MannyServiceProvider::class
	    ];
	}
	
	protected function getPackageAliases($app)
	{
	    return [
	        Manny::class => \Hallindavid\Manny\MannyFacade::class
	    ];
	}

	public $test = "The Sun is at an average distance of about 93,000,000 miles (150 million kilometers) away from Earth.";

	public function test_num() {
        $this->assertEquals( 	Manny::num($this->test),
								Manny::reg($this->test, ['num']) );
    }

    public function test_numc() {
        $this->assertEquals( 	Manny::numc($this->test),
								Manny::reg($this->test, ['num', 'comma']) );
    }

    public function test_numd() {
        $this->assertEquals( 	Manny::numd($this->test),
								Manny::reg($this->test, ['num', 'decimal']) );
    }

    public function test_nums() {
        $this->assertEquals( 	Manny::nums($this->test),
								Manny::reg($this->test, ['num', 'space']) );
    }
    
    public function test_numcd() {
        $this->assertEquals( 	Manny::numcd($this->test),
								Manny::reg($this->test, ['num', 'comma', 'decimal']) );
    }

    public function test_numcds() {
        $this->assertEquals( 	Manny::numcds($this->test),
								Manny::reg($this->test, ['num', 'comma', 'decimal', 'space']) );
    }




    public function test_alpha() {
        $this->assertEquals( 	Manny::alpha($this->test),
								Manny::reg($this->test, ['alpha']) );
    }

    public function test_alphanum() {
        $this->assertEquals( 	Manny::alphanum($this->test),
								Manny::reg($this->test, ['alpha', 'num']) );
    }

    
    

    


}