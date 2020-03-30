<?php

namespace Manny;

/**
 * Mask takes care of masking common fixed-length, alpha-numeric patterns for you.
 * Examples:.
 *
 * //US Social Security Number
 * Manny::mask("123456789", "111-11-1111"); //Outputs: 123-45-6789
 * //Canadian Social Insurance Number
 * Manny::mask("989787676", "111-111-111") //Outputs: "989-787-676"
 *
 * //Canadian Postal Code
 * Manny::mask("K1M1M4", "A1A 1A1"); //Outputs: "K1M 1M4"
 *
 * //Also great for phone numbers if you don't care about the trailing space - like the extension
 * Manny::mask('8008008000', "(111) 111-1111"); //Outputs: "(800) 800-8000"
 *
 * Note: this function likely isn't right for you if you have letters or numbers in the formatting.
 */
class Mask
{
    public $target;
    public $mask;

    public function __construct($target, $pattern)
    {
        if (!is_string($target)) {
            throw new \InvalidArgumentException('Mask target expected to be string');
        }
        if (!is_string($pattern)) {
            throw new \InvalidArgumentException('Mask pattern expected to be string');
        }

        $this->target = $target;
        $this->pattern = $pattern;
    }

    public function mask()
    {

        $nums = str_split(Manny::stripper($this->target, ['num']));
        $alphas = str_split(Manny::stripper($this->target, ['alpha']));

        $output = [];
        if (strlen($this->target) > 0) {
            foreach (str_split($this->pattern) as $char) {
                if ($char === 'A') {
                    //this means we want to take the first element that's left in our alphas array and append it to output.
                    if (count($alphas) == 0) {
                        break;
                    }
                    $output[] = array_shift($alphas);
                } elseif ($char === '1') {
                    if (count($nums) == 0) {
                        break;
                    }
                    $output[] = array_shift($nums);
                } else {
                    $output[] = $char;
                }
            }
        }

        return implode($output);
    }
}
