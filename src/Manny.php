<?php
namespace Hallindavid\Manny;
class Manny
{
	/**
     * Cleans a string down to it's digits
     * 
     * @param String $str
     * @return String
     */
    private function clean_phone($str) {
    	return preg_replace("/[^0-9]/","", $str);
    }

    private function get_phone_parts($phone_number) {
    	//clean the string down to it's digits
    	$clean = $this->clean_phone($phone_number); 
        $add_country = (strlen($clean) > 0);
    	if (substr($clean,0,1) == "1") {
    		$clean = substr($clean,1);
    	}

    	return [	
    			'country'=>($add_country > 0 ? "1" : ""),
				'area'=>(strlen($clean) > 0 ? substr($clean,0,3) : ""),
				'exchange'=>(strlen($clean) > 3 ? substr($clean,3,3) : ""),
				'line'=>(strlen($clean) > 6 ? substr($clean,6,4) : ""),
				'extension'=>(strlen($clean) > 10 ? substr($clean,10) : "") 
		];
    }

    function make_phone($phone_number, $format_config) {
		$phone = $this->get_phone_parts($phone_number);
    	$format_parts = $format_config['parts']; //get's the parts of the phone number the user wants

    	$format_delimiters = (	array_key_exists('delimiters', $format_config) 	&& 	is_array($format_config['delimiters']) 
    							? $format_config['delimiters'] 
    							: [] 	); // if there are delimiters, then let's get them.
		$parts = [
			"prefix"=>"",
			"country"=>"",
			"country_area"=>"",
			"area"=>"",
			"area_exchange"=>"",
			"exchange"=>"",
			"exchange_line"=>"",
			"line"=>"",
			"line_extension"=>"",
			"extension"=>""
		];

		//Fill in the phone parts
		if (count($format_parts) > 0) {
			foreach($format_parts as $part) {
				if (array_key_exists($part, $parts) && array_key_exists($part, $phone))
				{
					$parts[$part] = $phone[$part];
				}
			}
		}

		//Fill in the delimiter parts
		if (count($format_delimiters) > 0) {
			foreach($format_delimiters as $key=>$val) {
				if  ((array_key_exists($key, $format_delimiters) && array_key_exists($key, $parts))
                        && (    ($key == 'prefix' && (strlen($parts['country']) > 0)) ||
                                ($key == 'country_area' && (strlen($parts['area']) > 0)) ||
                                ($key == 'area_exchange' && (strlen($parts['exchange']) > 0)) ||
                                ($key == 'exchange_line' && (strlen($parts['line']) > 0)) || 
                                ($key == 'line_extension' && (strlen($parts['extension']) > 0))))
                    {
					$parts[$key] = $val;
				}
			}
		}
		return trim(implode($parts));
    }



	/**
	 * Beautifully Formats a north american phone number
	 * @param String $phone_number
	 * @param String $format - see the phonehelper.php config file to see options
	 * @param Boolean $extension - if set to true, enables extensions
	 * 
	 * @return String - the beautifully formatted phone number in the format of your choosing
	 */ 
	public function format($phone_number, $format = NULL)
    {
    	$desired_format = $this->default_format;

    	if (!is_string($phone_number))
    	{
    		//if phone number isn't a string, we wrap up here #thatwaseasy
    		if (config('phonehelper.throw_errors')) {
    			throw new InvalidArgumentException('phone number expected to be a string');
    		} 
    		return "";
    	}

    	if (!is_null($format)) { // format was passed into function, so we need to handle it
    		if (is_string($format)) {
    			if (array_key_exists($format, config('phonehelper.formats'))) {
    				$desired_format = $format;
    			} else {
    				// Format was not in the config file.  Throw an error OR proceed using defaults
    				if (config('phonehelper.throw_errors')) {
    					throw new OutOfBoundsException('the format was not found in your phonehelper configuration file');
    				}
    			}
    		} else {
    			// Something else was passed into the format field.  Throw an error or proceed using defaults
    			if (config('phonehelper.throw_errors')) {
    				throw new InvalidArgumentException('the format parameter was expecting a string');
    			}
    		} 
    	}

    	//Ensure format exists in the system
    	if (!array_key_exists($desired_format, config('phonehelper.formats'))) {
    		if (config('phonehelper.throw_errors')) {
    			throw new OutOfBoundsException('the format was not found in your phonehelper configuration file');
    		} else {
    			return "";
    		}
    	}

    	$format_config = config('phonehelper.formats')[$desired_format];
    	
    	//let's make sure our format_config is properly structured.
    	if (!(array_key_exists("parts", $format_config)	&& (count($format_config['parts']) > 0))) {
    		// this means that our format is either missing the parts key, or the parts array is empty
    		if (config('phonehelper.throw_errors')) {
    			throw new OutOfBoundsException('the format is either missing the parts key, or the parts array is empty');
    		} else {
    			return "";
    		}
    	}
    	//Now we know what the user wants, lets get to work
    	return $this->make_phone($phone_number, $format_config);
    }


}





