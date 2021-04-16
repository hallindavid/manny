<?php

namespace Manny;

//This class should be a static handler of all the primary class functions.
class Manny
{
    public static function phone($number, $options = null)
    {
        return (new Phone($number, $options))->format();
    }

    public static function yoink($target, $elements, $defaults = null)
    {
        return (new Yoink($target, $elements, $defaults))->filter();
    }

    public static function stripper($target, $options = null)
    {
        return (new Stripper($target, $options))->strip();
    }

    public static function crumble($target, $crumbs, $appendExtra = false)
    {
        return (new Crumble($target, $crumbs, $appendExtra))->crumble();
    }

    public static function mask($target, $pattern)
    {
        return (new Mask($target, $pattern))->mask();
    }

    public static function percent($num, $denom, $precision = 0)
    {
        return (new Percent($num, $denom, $precision))->percent();
    }
}
