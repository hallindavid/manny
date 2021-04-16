<?php

namespace Manny;

/**
 *
 * Clean is a wrapper around preg_replace with easy-to-remember options.
 * Clean is the new version of the stripper function, which is going to be removed this version.
 *
 *    remove all non-digits from string
 *    Manny::clean("With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!", ['num']);
 *  //Outputs: `51010`
 *
 *  just want the letters, numbers and spaces?
 *  Manny::stripper("With only 5-10 hours of development, Dave built Manny, saving him atleast 10 seconds per day!",
 *                    ['num', 'alpha','space']);
 *  //Outputs: `With only 510 hours of development Dave built Manny saving him atleast 10 seconds per day`
 *
 *    Available options are
 *    alpha - keep the alphabetical characters (case insensitive)
 *    num - keep the digits (0-9)
 *    comma - keep commas
 *    dot - keep periods
 *    dash - keep dashes/hyphens
 *    space - keep spaces
 */
class Clean
{
    public $target;
    public $mask;

    public function __construct($target, $pattern)
    {
        if (! is_string($target)) {
            throw new \InvalidArgumentException('Mask target expected to be string');
        }
        if (! is_string($pattern)) {
            throw new \InvalidArgumentException('Mask pattern expected to be string');
        }

        $this->target = $target;
        $this->pattern = $pattern;
    }

    public function mask()
    {
        $nums = [];
        $alphas = [];

        $nums_in_target = Manny::stripper($this->target, ['num']);
        $alphas_in_target = Manny::stripper($this->target, ['alpha']);

        if (strlen($nums_in_target) > 0) {
            $nums = str_split($nums_in_target);
        }

        if (strlen($alphas_in_target) > 0) {
            $alphas = str_split($alphas_in_target);
        }

        $output = [];

        if (strlen(Manny::stripper($this->target, ['num', 'alpha'])) > 0) {
            foreach (str_split($this->pattern) as $char) {
                if ($char === 'A') {
                    //this means we want to take the first element that's left in our alphas array and append it to output.
                    if (count($alphas) == 0) {
                        break;
                        //just end the flow altogether - we're done here.
                    }
                    $output[] = array_shift($alphas);
                } elseif ($char === '1') {
                    if (count($nums) == 0) {
                        break;
                        //just end the flow altogether - we're done here.
                    }
                    $output[] = array_shift($nums);
                } else {
                    if (count($alphas) == 0 && count($nums) == 0) {
                        break;
                    }
                    $output[] = $char;
                }
            }
        }

        return implode($output);
    }
}
