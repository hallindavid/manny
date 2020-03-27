<?php
namespace Hallindavid\Manny\Tests;

use Orchestra\Testbench\TestCase;

class CleanTest extends TestCase
{

	public $test1 = "
The \r\n quick 		brown   fox jumped over the lazy  dog 43 time  s.  
";

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
    
    public function test_clean() {
        $this->assertEquals( 	Manny::clean($this->test1), 
        						"The quick brown fox jumped over the lazy dog 43 time s." );
    }

  

}