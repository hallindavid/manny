<?php
namespace Hallindavid\Manny;
class Manny
{
   
    public function length($str, $length=NULL)
    {
        //ensure that $length is either NULL or an integer
        if (is_null($length)) {
            return $str;
        } else if (is_int($length)) {
            return substr($str,0,$length);
        } 
        throw new InvalidArgumentException('length only accepts NULL or an integer value');
    }


    /**
     * Clean a string with provided options
     * 
     * @param String $string
     * @param Array $options
     *  available keys for options are
     *      'alpha' - allows alphabetical characters
     *      'num'   - allows numerical characters
     *      'comma' - allow commas
     *      'decimal' - allow decimals
     *      'space'   - allow spaces
     */
    public function reg($string, $options = NULL) {
        if (is_null($options)) {
            //If options are null, default to cleaning it down to here.
            $options = ['alpha','num','comma','decimal','space'];
        }
        if (!is_array($options)) {
            throw new InvalidArgumentException('Reg function expects (string,array=null)');
        }

        $pattern = "/[^";
        $pattern .= (in_array('alpha', $options) ? "a-zA-Z" : "");
        $pattern .= (in_array('num', $options) ? "0-9" : "");
        $pattern .= (in_array('comma', $options) ? "," : "");
        $pattern .= (in_array('decimal', $options) ? "\." : "");
        $pattern .= (in_array('space', $options) ? " " : "");
        $pattern .= "]/";
        return preg_replace($pattern, "", $string);
    }

    //REG SHORTCUTS

    public function num($str,$length = NULL) {
        return $this->length($this->reg($str, ['num']),$length);
    }

    public function numc($str,$length = NULL) {
        return $this->length($this->reg($str, ['num', 'comma']),$length);
    }

    public function numd($str,$length = NULL) {
        return $this->length($this->reg($str, ['num', 'decimal']),$length);
    }

    public function nums($str,$length = NULL) {
        return $this->length($this->reg($str, ['num', 'space']),$length);
    }

    public function numcd($str,$length = NULL) {
        return $this->length($this->reg($str, ['num', 'comma', 'decimal']),$length);
    }

    public function numcds($str,$length = NULL) {
        return $this->length($this->reg($str, ['num', 'comma', 'decimal','space']),$length);
    }

    public function alpha($str,$length = NULL) {
        return $this->length($this->reg($str, ['alpha']),$length);
    }

    public function alphas($str,$length = NULL) {
        return $this->length($this->reg($str, ['alpha','space']),$length);
    }

    public function alphanum($str,$length = NULL) {
        return $this->length($this->reg($str, ['alpha','num']),$length);
    }

    public function alphanums($str,$length = NULL) {
        return $this->length($this->reg($str, ['alpha','num', 'space']),$length);
    }






    /**
     * Cleans whitespace from string - eg - double spaces, line breaks, leading and trailing white space
     */
    public function clean($str) {
        return trim(preg_replace('/\s+/', ' ',$str));
    }

    /**
     * Cleans whitespace from string - eg - double spaces, line breaks, leading and trailing white space
     */
    public function cleanse($str) {
        return trim(preg_replace('/\s+/', ' ',$str));
    }

    




}





