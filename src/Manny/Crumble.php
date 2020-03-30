<?php

namespace Manny;

/**
 * Crumble will take a string and returns an array of strings.
 * eg. Manny::crumble("18008008000888", [1,3,3,4])
 * //Output: ["1","800","800","8000"];.
 */
class Crumble
{
    public $string;
    public $crumbs;
    public $appendExtra;

    /**
     * @param string $string - the string we're going to crumble
     * @param array  $crumbs - array of string lengths for the crumbs
     */
    public function __construct($string, $crumbs, $appendExtra = false)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException('Crumble expects a string');
        }

        if (!is_array($crumbs)) {
            throw new \InvalidArgumentException('Crumble expects an array of integers');
        }

        if (!is_bool($appendExtra)) {
            throw new \InvalidArgumentException('Crumble expects append_extra parameter to be a boolean');
        }

        // Make sure crumbs are all valid,
        // allowed values are positive integers, or a *
        foreach ($crumbs as $crumb) {
            if (!(is_int($crumb) && $crumb > 0)) {
                throw new \InvalidArgumentException('Crumble expects an array of integers, received unexpected value in array');
            }
        }

        $this->string = $string;
        $this->crumbs = $crumbs;
        $this->appendExtra = $appendExtra;
    }

    public function crumble()
    {
        $output = [];
        $strpos = 0;
        foreach ($this->crumbs as $crumb) {
            $c = '';

            if ($strpos < strlen($this->string)) {
                $c = substr($this->string, $strpos, $crumb);
            }

            $strpos += $crumb;
            $output[] = $c;
        }

        if ($this->appendExtra) {
            $output[] = ($strpos < strlen($this->string) ? substr($this->string, $strpos) : '');
        }

        return $output;
    }
}
