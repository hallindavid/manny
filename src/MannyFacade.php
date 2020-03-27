<?php
	
	namespace Hallindavid\Manny;
	use Illuminate\Support\Facades\Facade;

	class MannyFacade extends Facade {

		protected static function getFacadeAccessor()
		{
		    return 'manny';
		}		
	}

?>