<?php

namespace Manny;

/**
 * Use Yoink to pull only selected keys from an associative array
 * Useful for things like filtering out extra keys from a $_POST array.
 */
class Yoink
{
    public $target;
    public $elements;
    public $defaults;

    public function __construct($target, $elements, $defaults = null)
    {
        if (!is_array($target)) {
            // I wonder if we should also have the options for a stdClass/object, convert it to an array, run yoink on it,
            // then convert back to object/stdClass
            throw new \InvalidArgumentException('Yoink expects an array');
        }

        if (!is_array($elements)) {
            throw new \InvalidArgumentException('Yoink expects an array of elements to pull from the target array');
        }

        if (!(is_array($defaults) || is_null($defaults))) {
            throw new \InvalidArgumentException('Yoink expects defaults parameter to be an array or NULL');
        }

        $this->target = $target;
        $this->elements = $elements;
        $this->defaults = $defaults;
    }

    public function filter()
    {
        //remove all unwanted elements
        $clean = array_intersect_key($this->target, array_flip($this->elements));

        //pad the array with default values
        if (is_array($this->defaults)) {
            $clean = array_merge($this->defaults, $clean);
        }

        return $clean;
    }
}
