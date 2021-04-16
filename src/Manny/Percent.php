<?php

namespace Manny;

/**
 * Percent is a bit opinionated.
 * When using invalid parameters, it will still generate a result.
 * it also doesn't allow percents over 100%, and assumes that 0/0 is 100%.
 */
class Percent
{
    public $num;
    public $denom;
    public $precision;

    public function __construct($num, $denom, $precision = 0)
    {
        //We're going to clean the values.
        $this->num = floatval(Manny::stripper(strval($num), ['num', 'dot']));
        $this->denom = floatval(Manny::stripper(strval($denom), ['num', 'dot']));
        $this->precision = intval(Manny::stripper(strval($precision), ['num']));
    }

    public function percent()
    {
        if ($this->denom > 0) {
            if ($this->num <= $this->denom) {
                return round(($this->num * 100 / $this->denom), $this->precision);
            } else {
                return 100;
            }
        }

        //this is where we're a opinionated.
        return 100;
    }
}
