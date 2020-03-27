<?php
namespace Hallindavid\Manny\Tests;

use Orchestra\Testbench\TestCase;

class RegTest extends TestCase
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

	//pass in alpha
	public function test_reg_alpha() {
        $this->assertEquals( 	Manny::reg($this->test, ['alpha']), 
        						"TheSunisatanaveragedistanceofaboutmilesmillionkilometersawayfromEarth" );
    }

    //pass in alpha num
	public function test_reg_alpha_num() {
        $this->assertEquals( 	Manny::reg($this->test, ['alpha','num']), 
        						"TheSunisatanaveragedistanceofabout93000000miles150millionkilometersawayfromEarth" );
    }

    public function test_reg_alpha_num_space() {
        $this->assertEquals( 	Manny::reg($this->test, ['alpha','num','space']), 
        						"The Sun is at an average distance of about 93000000 miles 150 million kilometers away from Earth" );
    }

    public function test_reg_alpha_num_space_decimal() {
        $this->assertEquals( 	Manny::reg($this->test, ['alpha','num','space','decimal']), 
        						"The Sun is at an average distance of about 93000000 miles 150 million kilometers away from Earth." );
    }

    public function test_reg_alpha_num_space_decimal_comma() {
        $this->assertEquals( 	Manny::reg($this->test, ['alpha','num','space','decimal', 'comma']), 
        						"The Sun is at an average distance of about 93,000,000 miles 150 million kilometers away from Earth." );
    }

    //pass in null to the options, should default to all the provided 
    public function test_reg_null() {
        $this->assertEquals( 	Manny::reg($this->test), 
        						"The Sun is at an average distance of about 93,000,000 miles 150 million kilometers away from Earth." );
    }

    
    

    


}