<?php
namespace Manny;


/**
 * Do you struggle with forgetfullness when it comes to writing regular expressions?
 * Are you tired of making the same 10 second google search for the hundredth time?
 * Well you're not alone!
 * Stripper is an easy to use solution allowing you to get the results you need without having to remember much.
 * 
 * Use Many today for some of these common functions!
 * 
 * 	remove all non-digits from string  
 * 	Manny::stripper("With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!", ['num']);
 *  //Outputs: `51010`
 * 
 *  just want the letters, numbers and spaces?
 *  Manny::stripper("With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!", 
 * 					['num', 'alpha','space']);
 *  //Outputs: `With only 510 hours of development Dave built Manny saving him atleast 10 seconds per day`
 *  
 *	Available options are 
 *  	alpha - keep the alphabetical characters (case insensitive)
 * 		num - keep the digits (0-9)
 *  	comma - keep commas
 *  	dot - keep periods
 * 		dash - keep dashes/hyphens
 *  	space - keep spaces
 */

class Stripper {

	public $text;
	public $options;
	public $defaults = ['alpha','num','comma','dot','space','dash'];

	/**
	 * @param string $text - the subject of our stripping
	 * @param array|NULL $options - the selection you'd like to to regex
	 */
	public function __construct($text, $options = NULL) {
		if (!is_string($text)) {
			throw new \InvalidArgumentException("Stripper expects a string");
		}
		if (is_null($options)) {
			$options = $this->defaults;
		} else if (!is_array($options)) {
			throw new \InvalidArgumentException("Stripper Options must be an array or NULL");
		}

		$this->text = $text;
		$this->options = $options;
	}

	public function strip() {
		return preg_replace($this->getRegExString(), "", $this->text);
	}

	private function getRegExString() {
        return "/[^"
		        	. (in_array('alpha', $this->options) ? "a-zA-Z" : "")
		        	. (in_array('num', $this->options) ? "0-9" : "")
		        	. (in_array('comma', $this->options) ? "," : "")
		        	. (in_array('dot', $this->options) ? "\." : "")
		        	. (in_array('dash', $this->options) ? "\-" : "")
		        	. (in_array('space', $this->options) ? " " : "")
		        . "]/";
	}



}