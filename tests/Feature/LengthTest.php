<?php
namespace Hallindavid\Manny\Tests;

use Orchestra\Testbench\TestCase;

class LengthTest extends TestCase
{

	public $shortmix = "The quick brown fox jumped over the lazy dog 43 times.";
	public $longmix = "The Sun is at an average distance of about 93,000,000 miles (150 million kilometers) away from Earth.";

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

    
    public function test_mixed_string_no_length_limit() {
        $this->assertEquals( 	Manny::length($this->shortmix), 
        						$this->shortmix );
    }

    public function test_mixed_string_length_limited() {
    	$this->assertEquals(	Manny::length($this->longmix, 8), 
    							"The Sun "	);
    }


}